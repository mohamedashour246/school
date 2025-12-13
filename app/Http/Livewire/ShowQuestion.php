<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $quizze_id , $student_id , $data , $counter = 0 , $questioncount = 0;


    public function render()
    {
        $this->data = Question::where('quiz_id',$this->quizze_id)->get();
        $this->questioncount = $this->data->count();

        return view('livewire.show-question',['data']);
    }

    public function nextQuestion($question_id,$score,$answer,$right_answer)
    {

        $studegree = Degree::where('student_id',$this->student_id)
            ->where('quiz_id',$this->quizze_id)->first();

        if($studegree == null)
        {
            $degree = new Degree();
            $degree->quiz_id = $this->quizze_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;
            if(strcmp(trim($answer),trim($right_answer)) === 0)
            {
                $degree->score += $score;
            }

            else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();

        }
        else {
            if($studegree->question_id >= $this->data[$this->counter]->id) {
                $studegree->score = 0;
                $studegree->abuse = '1';
                $studegree->save();

                     return redirect()->route('student_exams.index')->with('error','تم الغاء الاختبار لاكتشاف تلاعب النظام');
            }
            else {
                $studegree->question_id = $question_id;

                if(strcmp(trim($answer),trim($right_answer)) === 0)
                {
                    $studegree->score += $score;
                }
                else {
                    $studegree->score += 0;
                }
                $studegree->save();
            }
        }

        if($this->counter < $this->questioncount - 1)
        {
            $this->counter++;
        }
        else {

            return redirect()->to('student/dashboard/student_exams')->with('success','تم اجراء الاختبار بنجاح');
        }

        //  return redirect('student/dashboard/student_exams')->with('success','تم اجراء الاختبار بنجاح');
    }
}
