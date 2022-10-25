<?php

namespace Classes;


use Carbon\Carbon;

trait DataBase
{

  // private function __helper()
  // {
  //   self::creating(function ($model) {
  //     // ... code here
  //   });

  //   self::created(function ($model) {
  //     // ... code here
  //   });

  //   self::updating(function ($model) {
  //     // ... code here
  //   });

  //   self::updated(function ($model) {
  //     // ... code here
  //   });

  //   self::deleting(function ($model) {
  //     // ... code here
  //   });

  //   self::deleted(function ($model) {
  //     // ... code here
  //   });
  // }


  public static function create(array $attributes = [])
  {
    $model = new static();
    if (!empty($attributes)) {
      $model = static::query()->create($attributes);
    }
    return $model;
  }

  public function isFilled()
  {
    return ($this->getid()) ? true : false;
  }

  public function getId()
  {
    return $this->{$this->primaryKey};
  }

  public function getValue($value)
  {
    if ($this->isFilled()) {
      return ($this->{$value}) ? $this->{$value} : old($value);
    } else {
      return old($value);
    }
  }


  public function getStatus()
  {
    switch ($this->status) {
      case 1:
        $return =  (object) [
          'badge' => 'success',
          'text' => 'Ativo',
        ];
        break;
      case 0:
        $return = (object) [
          'badge' => 'danger',
          'text' => 'Inativo',
        ];
        break;
    }
    return $return;
  }
}
