<?php


namespace App\Http\Livewire\Trainer;

use App\Models\Event;
use App\Models\User;
use App\Models\UserAttendance;
use App\Models\Weekday;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Calender extends Component
{





    public function render()
    {
        $events = [];
        $attendances = Event::all();

        foreach ($attendances as $attendance) {
            $color = ($attendance->title === 'Aanwezig') ? 'green' : 'red';
            $userAttendance = UserAttendance::where('event_id', $attendance->id)->first();

            if ($userAttendance) {
                $user = User::find($userAttendance->user_id); // Fetch the user based on user_id

                if ($user) {
                    $title = $user->full_name .  ' is  '  . $attendance->title;
                } else {
                    $title = $attendance->title;
                }
            } else {
                $title = $attendance->title;
            }

            $events[] = [
                'id' => $attendance->id,
                'title' => $title,
                'start' => Carbon::createFromFormat('Y-m-d', $attendance->start_date)->toDateString(),
                'end' => Carbon::createFromFormat('Y-m-d', $attendance->end_date)->toDateString(),
                'color' => $color,
            ];
        }
//        $events = [];
//        $attendances = Event::all();
//        foreach ($attendances as $attendance) {
//            $color = ($attendance->title === 'Aanwezig') ? 'green' : 'red';
//            $events[] =
//                [
//                    'id' => $attendance->id,
//                    'title' => $attendance->title,
//                    'start'=>Carbon::createFromFormat('Y-m-d', $attendance->start_date)->toDateString(),
//                    'end' => Carbon::createFromFormat('Y-m-d', $attendance->end_date)->toDateString(),
//                    'color'=> $color,
//                ];
//        }
        return view('livewire.trainer.calender', compact('events', 'attendances'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Voorkeur doorgeven',
                'title' => 'Agenda',
            ]);
    }

//    public $showModal = false;
//    public $eventId;
//    public $weekdayId;
//    public $selectedEvenId;
//    public $isOpen = 0;
//    public $weekday = '%';
//    public $weekdays;
//    public $fullName;
//    public $full_name;
//    public $userId;
//    public $theUser;
//
//
//    public $user = '%';
//    public $name;
//
//    public $selectedWeekday;
//
//    public function showWeekday($weekday)
//    {
//        $this->selectedWeekday = $weekday;
//    }
//
//    public $selectedDate;
//
//    public function dateSelected($date)
//    {
//        $this->selectedDate = $date;
//    }
//
//
//    protected $listeners = ['openModal' => 'openModal',
//        'newAttendanceUpdated' => 'setNewAttendance',
//        'setNewAttendance' => 'createAttendance',
//        'showWeekday' => 'showWeekday'];
//
//    public $newAttendance = [
//        'id' => null,
//        'user_id' => null,
//        'weekday_id' => null,
//        'present_start' => null,
//        'present_end' => null,
//        'absent_start' => null,
//        'absent_end' => null,
//    ];
//
//    public function setNewAttendance($userAttendance = null)
//    {
//        $userWithAttendance = UserAttendance::find($userAttendance);
//
//        if ($userAttendance) {
//            $event = [
//                'id' => $userWithAttendance->id,
//                'title' => $this->name,
//                'start' => Carbon::parse($userWithAttendance->weekday->weekday . ' ' . $userWithAttendance->present_start)->format('H:i'),
//                'end' => Carbon::parse($userWithAttendance->weekday->weekday . ' ' . $userWithAttendance->present_end)->format('H:i'),
//            ];
//
//            if ($userWithAttendance->absent_start) {
//                $event['title'] = ' (absent)';
//                $event['start'] = Carbon::parse($userWithAttendance->weekday->weekday . ' ' . $userWithAttendance->absent_start)->format('H:i');
//                $event['end'] = Carbon::parse($userWithAttendance->weekday->weekday . ' ' . $userWithAttendance->absent_end)->format('H:i');
//            }
//
//            $this->newAttendance = $event;
//        } else {
//            $this->reset('newAttendance');
//        }
//
//        $this->showModal = true;
//    }
//
//    public function mount()
//    {
//
//        $this->selectedDate = null;
//
//        $this->listeners += ['selectedDate' => 'handleSelectDate'];
//
//        $this->weekdayId = UserAttendance::where('weekday_id', 'like', $this->weekday)->value('id'); dump($this->weekdayId);
//
//        $this->weekdays = Weekday::all();
//
//
//        $this->userId = UserAttendance::where('user_id', 'like', $this->user)->value('id');dump($this->userId);
//        $this->theUser = User::find($this->userId)->full_name;dump($this->theUser);
//    }
//
//    public function handleSelectDate($date)
//    {
//        $this->selectedDate = $date;dump($date);
//    }
//
//    public function createAttendance()
//    {
//        $userAttendance = UserAttendance::create([
//            'user_id' => $this->user->id,
//            'weekday_id' => $this->weekdayId,
//            'present_start' => $this->newAttendance['start'],
//            'present_end' => $this->newAttendance['end'],
//            'absent_start' => $this->newAttendance['start'],
//            'absent_end' => $this->newAttendance['end'],
//        ]);
//        $this->showModal = false;
//        $this->dispatchBrowserEvent('swal:toast', [
//            'background' => 'success',
//            'html' => "Jouw voorkeur is gewijzigd",
//        ]);
//    }
//    public function updateAttendance(UserAttendance  $userAttendance)
//    {
//        $userAttendance->update([
//            'user_id' => $this->user->id,
//            'weekday_id' => $this->weekdayId,
//            'present_start' => $this->newAttendance['start'],
//            'present_end' => $this->newAttendance['end'],
//            'absent_start' => $this->newAttendance['start'],
//            'absent_end' => $this->newAttendance['end'],
//        ]);
//        $this->showModal = false;
//        $this->dispatchBrowserEvent('swal:toast', [
//            'background' => 'success',
//            'html' => "Jouw voorkeur is gewijzigd",
//        ]);
//    }
//    public function deleteAttendance(UserAttendance $userAttendance)
//    {
//        $userAttendance->delete();
//        $this->dispatchBrowserEvent('swal:toast', [
//            'background' => 'success',
//            'html' => "Deze gebeurtenis is verwijderd.",
//        ]);
//    }
//
//
//        public function openModal($eventId) {
////        $this->selectedEvenId = $eventId;
//        $this->setNewAttendance($eventId);
//    }
//
//
//    public function render()
//    {
//        $user_attendances = UserAttendance::with('user')->with('weekday')->get();dump($user_attendances);
//        $events = collect($user_attendances)->map(function ($attendance) {
//            $event = [
//                'id' =>  $attendance->id,
//                'title' => $attendance->user->full_name,
//                // Convert the weekday and times to ISO 8601 format
//                'start' => Carbon::parse($attendance->weekday->weekday . ' ' . $attendance->present_start)->toIso8601String(),
//                'end' => Carbon::parse($attendance->weekday->weekday . ' ' . $attendance->present_end)->toIso8601String(),
//                'color' => 'green',
//                'background' => 'blue',
//            ];
//
//            if ($attendance->absent_start) {
//                $event['title'] = ' (absent)';
//                $event['start'] = $attendance->weekday->weekday . ' ' . $attendance->absent_start;
//                $event['end'] = $attendance->weekday->weekday . ' ' . $attendance->absent_end;
//                $event['color'] = 'red'; // set the color to red for absent events
//            }
//            //dump($event);
//            return $event;
//        });
//        return view('livewire.trainer.calender', compact('events', 'user_attendances'))
//            ->layout('layouts.hockeyclub', [
//                'description' => 'Voorkeur doorgeven',
//                'title' => 'Agenda',
//            ]);
//    }
}
