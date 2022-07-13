<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $table = 'dictionary';
    
    use HasFactory;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEnglish(): string
    {
        return $this->english;
    }

    public function setEnglish(string $english): self
    {
        $this->english = $english;
        return $this;
    }

    public function getInterslavic(): string
    {
        return $this->interslavic;
    }

    public function setInterslavic(string $interslavic): self
    {
        $this->interslavic = $interslavic;
        return $this;
    }
}
