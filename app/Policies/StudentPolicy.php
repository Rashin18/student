<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;

class StudentPolicy
{
    /**
     * Determine if the user can view any students.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTeacher();
    }

    /**
     * Determine if the user can view the student.
     */
    public function view(User $user, Student $student): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher()) {
            $this->loadBatchRelationship($student);
            return $student->batch && $student->batch->teacher_id === $user->id;
        }

        return false;
    }

    /**
     * Determine if the user can create students.
     */
    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    /**
     * Determine if the user can store a new student.
     */
    public function store(User $user): bool
    {
        return $this->create($user);
    }

    /**
     * Determine if the user can update the student.
     */
    public function update(User $user, Student $student): bool
    {
        return $this->view($user, $student);
    }

    /**
     * Determine if the user can delete the student.
     */
    public function delete(User $user, Student $student): bool
    {
        return $this->update($user, $student);
    }

    /**
     * Load batch relationship if not already loaded.
     */
    protected function loadBatchRelationship(Student $student): void
    {
        if (!$student->relationLoaded('batch')) {
            $student->load('batch');
        }
    }
}