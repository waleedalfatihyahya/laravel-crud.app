<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Student;

class Crud extends Component
{

    //define public variables
    public $students, $name, $email, $mobile, $student_id, $Image;
    public $isModalOpen = 0;
    //render the logic to the given route
    public function render()
    {
        $this->students = Student::all();
        return view('livewire.crud');
    }

    //create a create function
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    // create a reset function
    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->Image='';
    }
// create a store function
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',

        ]);

        //update function

        Student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'Image' => $this->Image,
        ]);
        session()->flash('message', $this->student_id ? 'Student updated.' : 'Student created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    //edit function
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->mobile = $student->mobile;
        $this->Image = $student->Image;

        $this->openModalPopover();
    }
// delete function
    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Studen deleted.');
    }
}
