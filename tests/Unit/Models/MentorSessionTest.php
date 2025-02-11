<?php

use App\Models\MentorSession;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('MentorSession Model', function () {
    beforeEach(function () {
        $this->seed(RoleSeeder::class);
        $this->mentor = User::factory()->create();
        $this->menti = User::factory()->create();
    });

    it('can create session with basic attributes', function () {
        $mentorSession = MentorSession::factory()->create([
            'mentor_id' => $this->mentor->getKey(),
            'menti_id' => $this->menti->getKey(),
            'date' => now(),
            'cost' => 99.99,
            'is_success' => true,
            'is_paid' => true,
            'is_cancelled' => false,
            'is_date_changed' => false,
        ]);

        expect($mentorSession)->toBeInstanceOf(MentorSession::class)
            ->and($mentorSession->mentor_id)->toBe($this->mentor->getKey())
            ->and($mentorSession->menti_id)->toBe($this->menti->getKey())
            ->and($mentorSession->cost)->toBe(99.99)
            ->and($mentorSession->is_success)->toBeTrue()
            ->and($mentorSession->is_paid)->toBeTrue()
            ->and($mentorSession->is_cancelled)->toBeFalse()
            ->and($mentorSession->is_date_changed)->toBeFalse();
    });

    it('can create session with basic attributes and casts are correct', function () {
        $mentorSession = MentorSession::factory()->create([
            'mentor_id' => $this->mentor->getKey(),
            'menti_id' => $this->menti->getKey(),
            'date' => '2024-02-10 15:00:00',
            'cost' => '99.99',
            'is_success' => 1,
            'is_paid' => 1,
            'is_cancelled' => 0,
            'is_date_changed' => 0,
        ]);

        expect($mentorSession)->toBeInstanceOf(MentorSession::class)
            ->and($mentorSession->mentor_id)->toBe($this->mentor->getKey())
            ->and($mentorSession->menti_id)->toBe($this->menti->getKey())
            ->and($mentorSession->cost)->toBe(99.99)
            ->and($mentorSession->is_success)->toBeTrue()
            ->and($mentorSession->is_paid)->toBeTrue()
            ->and($mentorSession->is_cancelled)->toBeFalse()
            ->and($mentorSession->is_date_changed)->toBeFalse()
            ->and($mentorSession->date)->toBeInstanceOf(DateTime::class);
    });

    it('has relationship with mentor', function () {
        $mentorSession = MentorSession::factory()->create([
            'mentor_id' => $this->mentor->getKey(),
            'menti_id' => $this->menti->getKey(),
        ]);

        expect($mentorSession->mentor)->toBeInstanceOf(User::class)
            ->and($mentorSession->mentor->getKey())->toBe($this->mentor->getKey());
    });

    it('has relationship with menti', function () {
        $mentorSession = MentorSession::factory()->create([
            'mentor_id' => $this->mentor->getKey(),
            'menti_id' => $this->menti->getKey(),
        ]);

        expect($mentorSession->menti)->toBeInstanceOf(User::class)
            ->and($mentorSession->menti->id)->toBe($this->menti->getKey());
    });

    it('cascades on mentor deletion', function () {
        $mentorSession = MentorSession::factory()->create([
            'mentor_id' => $this->mentor->getKey(),
            'menti_id' => $this->menti->getKey(),
        ]);

        $this->mentor->delete();

        $this->assertDatabaseMissing('mentor_sessions', [
            'id' => $mentorSession->getKey()
        ]);
    });

    it('cascades on menti deletion', function () {
        $mentorSession = MentorSession::factory()->create([
            'mentor_id' => $this->mentor->getKey(),
            'menti_id' => $this->menti->getKey(),
        ]);

        $this->menti->delete();

        $this->assertDatabaseMissing('mentor_sessions', [
            'id' => $mentorSession->getKey()
        ]);
    });
});
