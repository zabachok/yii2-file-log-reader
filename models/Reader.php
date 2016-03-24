<?php

namespace zabachok\logreader\models;

class Reader
{
    public $path;
    public $filename;

    protected $handle;
    protected $pattern = '|^([\d\-: ]{19}) \[([\d\.\-]*)\]\[([\d\-]*)\]\[([\d\w\-]*)\]\[(.*)\]\[(.*)\] (.*$)|u';
    protected $matches = [
        0 => 'origin',
        1 => 'date',
        2 => 'ip',
        3 => 'user_id',
        4 => 'session_id',
        5 => 'level',
        6 => 'category',
        7 => 'text',
    ];
    protected $seek = 0;
    protected $length = -10;
    protected $opened = false;
    public $mtime;
    private $body = '';
    private $index = 0;
    public $ignore = [
        ['level'=>'info', 'category' =>'application'],
    ];

    public function __construct($path, $filename)
    {
        $this->path = $path;
        $this->filename = $filename;
        $this->mtime = filemtime($this->path . '/' . $this->filename);
    }

    public function open()
    {
        if($this->opened) return true;
        if(!file_exists($this->path . '/' . $this->filename)) return false;
        $this->handle = fopen($this->path . '/' . $this->filename, 'r');
        $s = fseek($this->handle, $this->length, SEEK_END);
        $this->seek();
        $this->opened = true;
        return true;
    }

    public function getRow()
    {
        if(!$this->open()) return null;
        $this->body = '';
        $i = 0;
        while($i < 1000)
        {
            $i++;
            $line = fgets($this->handle);

            $data = $this->parseTitle($line);
            if($data === false) $this->body = $line . $this->body;
            else{
                if($this->isIgnore($data))
                {
                    $this->body = $line . $this->body;
                    continue;
                }
                $this->body = $data['text'] . "\n" . $this->body;
                $model = new LogLine();
                $model->attributes = array_merge($data, [
                    'index'=>$this->index++,
                    'text'=>$this->body,
                    'firstLine' => $data['text'],
                ]);
                return $model;
            }

            $this->seek();
        }

    }

    public function seek()
    {
        while(true)
        {
            $this->length--;
            if(fseek($this->handle, $this->length, SEEK_END) === false) return false;
            if(fgetc($this->handle) == "\n") return;
        }
    }

    public function isIgnore($data)
    {
        foreach($this->ignore as $item)
        {
            if($item['level'] == $data['level'] && $item['category'] == $data['category']) return true;
        }
        return false;
    }

    public function parseTitle($line)
    {
        if(!preg_match($this->pattern, $line, $matches)) return false;
        $result = [];
        foreach ($matches as $key => $match)
        {
            if(!isset($this->matches[$key])) continue;
            $result[$this->matches[$key]] = $match;
        }
        return $result;
    }

    public function __destruct()
    {
        if(!empty($this->handle)) fclose($this->handle);
    }
}