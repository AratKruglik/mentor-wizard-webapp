<?php

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

covers(Attachment::class);

it('check fillable attributes', function ($field) {
    $attachment = new Attachment();
    $fillable = $attachment->getFillable();
    expect($fillable)->toContain($field);
})->with(['hash_name', 'file_name', 'file_size', 'mime_type']);

it('creates attachment correctly', function () {
    $attachment = Attachment::factory()->create([
        'attachable_id' => 1,
        'attachable_type' => User::class,
        'hash_name' => 'test_hash.jpg',
        'file_name' => 'original.jpg',
        'file_size' => 12345,
        'mime_type' => 'image/jpeg',
    ]);

    expect($attachment)->toBeInstanceOf(Attachment::class)
        ->and($attachment->attachable_id)->toBe(1)
        ->and($attachment->attachable_type)->toBe(User::class)
        ->and($attachment->hash_name)->toBe('test_hash.jpg')
        ->and($attachment->file_name)->toBe('original.jpg')
        ->and($attachment->file_size)->toBe(12345)
        ->and($attachment->mime_type)->toBe('image/jpeg')
        ->and($attachment->attachable())->toBeInstanceOf(MorphTo::class);

});

it('Creating an object with attributes set to null', function ($field) {
    $this->expectExceptionMessage('null value in column "'.$field.'"');
    $fields = [
        'attachable_id' => 1,
        'attachable_type' => User::class,
        'hash_name' => 'test_hash.jpg',
        'file_name' => 'original.jpg',
        'file_size' => 12345,
        'mime_type' => 'image/jpeg',
    ];

    foreach ($fields as $key => $item) {
        if($key == $field) $fields[$key] = null;
    }

    Attachment::factory()->create($fields);
})->with(['hash_name', 'file_name', 'file_size', 'mime_type'])->throws(QueryException::class);

it('has a precisely defined fillable configuration', function () {
    $attachment = new Attachment();
    $reflection = new ReflectionClass($attachment);
    $property  = $reflection->getProperty('fillable');
    $property ->setAccessible(true);
    $fillable = $property->getValue($attachment);

    expect($fillable)->toMatchArray([
        'hash_name',
        'file_name',
        'file_size',
        'mime_type',
    ]);
});
