<?php
namespace app\common\model;
use think\Model;

class Schedule extends Model {

    public function getDispatches()
    {
        return isset($this->data['dispatch']) ? $this->data['dispatch'] : $this->data['dispatch'] = Dispatch::where('schedule_id', 'eq', $this->getId())->select();
    }

    public function getId() 
    {
        return isset($this->data['id']) ? (int)$this->data['id'] : null;
    }

    public function getTeacher()
    {
        return isset($this->data['teacher']) ? $this->data['teacher'] : $this->data['teacher'] = Teacher::get($this->getTeacherId());
    }

    public function getTeacherId() 
    {
        return isset($this->data['teacher_id']) ? (int)$this->data['teacher_id'] : null;
    }

    public function getTerm()
    {
        return isset($this->data['term']) ? $this->data['term'] : $this->data['term'] = Term::get($this->getTermId());
    }

    public function getTermId() 
    {
        return isset($this->data['term_id']) ? (int)$this->data['term_id'] : null;
    }

    public function getCourse()
    {
        return isset($this->data['course']) ? $this->data['course'] : $this->data['course'] = Course::get($this->getCourseId());
    }
    
    public function getCourseId() 
    {
        return isset($this->data['course_id']) ? (int)$this->data['course_id'] : null;
    }

    public function Klasses()
    {
        return $this->belongsToMany('Klass', 'yunzhi_schedule_klass', 'klass_id', 'schedule_id');
    }
    
    static public function saveSchedule($teacherId, $termId, $courseId, &$msg='') {
        $schedule = new Schedule;
        $schedule->teacher_id = $teacherId;
        $schedule->term_id = $termId;
        $schedule->course_id = $courseId;
        $status = $schedule->save();
        $msg .= $schedule->getError();
        return $status ? $schedule : null;
    }

    static public function scheduleSave($teacherId, $courseId, $klassIds, $courseTimes, &$msg='') {
        //1、通过teacherId、termId、courseId先存schedule表
        $term = Term::getCurrentTerm();
        $schedule = Schedule::saveSchedule($teacherId, $term->id, $courseId, $msg);
        if (is_null($schedule)) return false;
        //2、通过scheduleId、klassIds 存schedule_klass表
        foreach ($klassIds as $klassId) {
            $scheduleKlass = ScheduleKlass::saveScheduleKlass($schedule->id, $klassId, $msg);
            if (is_null($scheduleKlass)) return false;
        }
        // 3、每个组件的值通过scheduleId、weeks、day、lesson来存dispatch表并获取到dispatchId
        // 4、通过dispatchIds和roomIds来存dispatch_room表
        for ($i=0; $i < 7; $i++) {
            for ($j=0; $j < 5; $j++) { 
                if ((!empty($courseTimes[$i][$j]->weeks)) && (!empty($courseTimes[$i][$j]->roomIds))) {
                    $day = $i;
                    $lesson = $j;
                    $weeks = $courseTimes[$i][$j]->weeks;
                    $roomIds = $courseTimes[$i][$j]->roomIds;
                    foreach ($weeks as $week) {
                        $dispatch = Dispatch::saveDispatch($schedule->id, $week, $day, $lesson, $msg);
                        if (is_null($dispatch)) return false;
                        foreach ($roomIds as $roomId) {
                            $dispatchRoom = DispatchRoom::saveDispatchRoom($dispatch->id, $roomId, $msg);
                            if (is_null($dispatchRoom)) return false;
                        }
                    }
                }
            }
        }
        return true;
    }

    public function Students()
    {
        return $this->belongsToMany('Student', 'yunzhi_student_schedule', 'student_id', 'schedule_id');
    }
    

}