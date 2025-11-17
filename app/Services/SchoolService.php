<?php

namespace App\Services;

use App\Models\Grade;
use App\Models\GradeSubject;
use App\Models\School;
use App\Models\Subject;

class SchoolService
{
    public function copyStructure(School $school, School $sourceSchool): void
    {
        try{
            $school->grade_flow = $sourceSchool->grade_flow;
            $sourceGradeSubjects = GradeSubject::where('school_id', $sourceSchool->id)->get();
            $newGradeSubjects = $sourceGradeSubjects->map(function ($gradeSubject) use ($school) {
                return [
                    'school_id' => $school->id,
                    'grade_id' => $gradeSubject->grade_id,
                    'subject_id' => $gradeSubject->subject_id,
                    'is_active' => $gradeSubject->is_active,
                ];
            });
            GradeSubject::where('school_id', $school->id)->delete();
            GradeSubject::insert($newGradeSubjects->toArray());
            $school->save();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao copiar estrutura: ' . $e->getMessage());
        }
    }

    public function addSubjectToGrade(int $schoolId, int $gradeId, int $subjectId, bool $isActive = true): void
    {
        try{
            $gradeSubject = new GradeSubject();
            $gradeSubject->school_id = $schoolId;
            $gradeSubject->grade_id = $gradeId;
            $gradeSubject->subject_id = $subjectId;
            $gradeSubject->is_active = $isActive;
            $gradeSubject->save();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao adicionar disciplina à série: ' . $e->getMessage());
        }
    }
}