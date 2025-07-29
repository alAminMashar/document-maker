<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

use App\Models\Disapproval;
use App\Models\Approval;
use App\Models\ModificationPayload as Payload;
use App\Models\User;

use App\Models\Deduction;
use App\Models\Employee;
use App\Models\EmployeeTermination;
use App\Models\EmployeeDeployment;
use App\Models\SalaryAdvance;
use App\Models\Gear;
use App\Models\InventoryRecord;
use App\Models\AttendanceRecord;
use App\Models\MassDeduction;

use App\Models\Helpers;

use App\Jobs\TerminateEmployee;


use Auth;

class Modification extends Model
{
    use HasFactory;

    protected $fillable  = [
        'modifiable_id',
        'modifiable_type',
        'description',
        'user_id',
        'active',
        'is_update',
        'approvers_required',
        'disapprovers_required',
    ];

    public function describeAll()
    {
        $mods = Modification::all();
        foreach($mods as $mod)
        {
            $mod->description = $mod->describe();
            $mod->save();
        }
    }

    public function description()
    {
        if($this->description == null){
            $this->describeAll();
        }
        return $this->description;
    }

    public function getAlias()
    {

        $alias = Helpers::mb_basename($this->modifiable_type);

        if(Helpers::mb_basename($this->modifiable_type) == 'Employee'){
            $alias = 'New Employee';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeDeployment'){
            $alias = 'Employee Deployment';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RelieverSchedule'){
            $alias = 'Reliever Deployment';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryAdvance'){
            $alias = 'Salary Advance';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryBonus'){
            $alias = 'Salary Allowance';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Gear'){
            $alias = 'Gear Issuance';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'InventoryRecord'){
            $alias = 'Inventory Transit';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeTermination'){
            $alias = 'Employee Dismissal';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeReinstatement'){
            $alias = 'Employee Reinstatement';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Deduction'){
            $alias = 'Salary Deduction';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'AttendanceRecord'){
            $alias = 'Leaves';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'MassDeduction'){
            $alias = 'Mass Salary Deduction';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryChange'){
            $alias = 'Salary Change';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'BankAccount'){
            $alias = 'Bank Account';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryBonus'){
            $alias = 'Recurrent Salary Allowance';
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryDeduction'){
            $alias = 'Recurrent Salary Deduction';
        }

        return $alias;

    }

    public static function getTypeNames()
    {
        $data = [
            'Employee',
            'EmployeeDeployment',
            'RelieverSchedule',
            'SalaryAdvance',
            'SalaryBonus',
            'Gear',
            'InventoryRecord',
            'EmployeeTermination',
            'EmployeeReinstatement',
            'Deduction',
            'AttendanceRecord',
            'MassDeduction',
            'SalaryChange',
            'BankAccount',
            'RecurrentSalaryBonus',
            'RecurrentSalaryDeduction',
        ];

        return $data;
    }

    //Describe the change request
    public function describe()
    {
        $description = $this->notifiable_type;

        if(Helpers::mb_basename($this->modifiable_type) == 'Employee'){
            //Find employee and set them to published.
            $modifiable = Employee::find($this->modifiable_id);
            if($modifiable)
            {
                $description = $this->modifiable['serial_number'].' '.$this->modifiable['first_name'] . ' ' . $this->modifiable['second_name'] . ' ' . $this->modifiable['other_name']. ' ' . $this->modifiable['phone']. ' ' . $this->modifiable['id_number'].' - Employee Onboarding.';
                $this->description = $description;
                $this->save();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeDeployment'){

            $modifiable = EmployeeDeployment::find($this->modifiable_id);
            if($modifiable){
                 $description = ucwords(str_replace('-',' ',$this->modifiable['slug']));
                $this->description = $description;
                $this->save();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RelieverSchedule'){

            $modifiable = RelieverSchedule::find($this->modifiable_id);
            if($modifiable)
            {
                 $description = ucwords(str_replace('-',' ',$this->modifiable['slug']));
                $this->description = $description;
                $this->save();;
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryAdvance'){
            $modifiable = SalaryAdvance::find($this->modifiable_id);
            if($modifiable){
                $description = ucwords(str_replace('-',' ',$this->modifiable['slug']));
                $this->description = $description;
                $this->save();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryBonus'){
            $modifiable = SalaryBonus::find($this->modifiable_id);
            if($modifiable){
                $description = ucwords(str_replace('-',' ',$this->modifiable['slug']));
                $this->description = $description;
                $this->save();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Gear'){
            $modifiable = Gear::find($this->modifiable_id);
            if($modifiable)
            {
                $description = ucwords(str_replace('-',' ',$this->modifiable['slug']));
                $this->description = $description;
                $this->save();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'InventoryRecord'){
            $modifiable = InventoryRecord::find($this->modifiable_id);
            if($modifiable){
                $description = ucwords(str_replace('-',' ',$this->modifiable['description'])).' - Inventory Transit Record';
                $this->description = $description;
                $this->save();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeTermination'){
            $modifiable = EmployeeTermination::find($this->modifiable_id);
            if($modifiable){
                $employee_name = $modifiable->employee->serial_number.' '.$modifiable->employee->name().' '.$modifiable->employee->phone;
                $description = "$employee_name. Reason: $modifiable->reason. Date: $modifiable->termination_date";
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeReinstatement'){
            $modifiable = EmployeeReinstatement::find($this->modifiable_id);
            if($modifiable){
                $employee_name = $modifiable->employee->serial_number.' '.$modifiable->employee->name().' '.$modifiable->employee->phone;
                $description = "$employee_name. Reason: $modifiable->reason. Date: $modifiable->reinstatement_date";
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Deduction'){
            $modifiable = Deduction::find($this->modifiable_id);
            if($modifiable){
                $description =$modifiable->describe();
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'AttendanceRecord'){
            $modifiable = AttendanceRecord::find($this->modifiable_id);
            if($modifiable){
                $description = str_replace("-"," ",$modifiable->slug);
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'MassDeduction'){
            $modifiable = MassDeduction::find($this->modifiable_id);
            if($modifiable){
                $description = str_replace("-"," ",$modifiable->slug);
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryChange'){
            $modifiable = SalaryChange::find($this->modifiable_id);
            if($modifiable){
                $description = $modifiable->describe();
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'BankAccount'){
            $modifiable = BankAccount::find($this->modifiable_id);
            if($modifiable){
                $description = $modifiable->describe();
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryBonus'){
            $modifiable = RecurrentSalaryBonus::find($this->modifiable_id);
            if($modifiable){
                $description = $modifiable->describe();
                $this->description = $description;
                $this->save();
            }
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryDeduction'){
            $modifiable = RecurrentSalaryDeduction::find($this->modifiable_id);
            if($modifiable){
                $description = $modifiable->describe();
                $this->description = $description;
                $this->save();
            }
        }

        return $description;

    }

    /*----------------------------------------------------------------------
    #
    #   Create A Modification
    #
    ----------------------------------------------------------------------*/
    public static function createModification($modifiable_id, $modifiable_type, $payload){

        //Requirements
        $approvers_required = config('app.approval_requirement');
        $disapprovers_required = config('app.disapproval_requirement');

        $mod = Modification::create([
            'modifiable_id'             =>  $modifiable_id,
            'modifiable_type'           =>  $modifiable_type,
            'approvers_required'        =>  $approvers_required,
            'disapprovers_required'     =>  $disapprovers_required,
            'user_id'                   =>  Auth::user()->id,
        ]);

        $mod->description = $mod->describe();
        $mod->save();

        if($payload =! null){
            //No
        }

        return $mod;

    }

    //Disapprove modification request
    private function nullify()
    {
        if(Helpers::mb_basename($this->modifiable_type) == 'Employee'){
            //Find employee and set them to published.
            $modifiable = Employee::findOrFail($this->modifiable_id);
            if(!$modifiable->published){
                //Delete if the employee wasn't published otherwise could cause issues
                $modifiable->delete();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeTermination'){
            $modifiable = EmployeeTermination::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeReinstatement'){
            $modifiable = EmployeeReinstatement::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeDeployment'){
            $modifiable = EmployeeDeployment::findOrFail($this->modifiable_id);
            //Update employee's deployment_status
            $employee = $modifiable->employee()->first();
            $employee->updateEngagementStatus();
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RelieverSchedule'){
            $modifiable = RelieverSchedule::findOrFail($this->modifiable_id);
            //Update employee's deployment_status
            $employee = $modifiable->employee()->first();
            $employee->updateEngagementStatus();
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryAdvance'){
            $modifiable = SalaryAdvance::findOrFail($this->modifiable_id);
            $modifiable->disapprove();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryBonus'){
            $modifiable = SalaryBonus::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Gear'){
            $modifiable = Gear::findOrFail($this->modifiable_id);
            $response = $modifiable->burnItToTheGround();
            if($response){
                $modifiable->delete();
            }

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'InventoryRecord'){

            $modifiable = InventoryRecord::findOrFail($this->modifiable_id);
            foreach($modifiable->items()->get() as $item){
                $item->delete();
            }
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Deduction'){

            $modifiable = Deduction::findOrFail($this->modifiable_id);
            $modifiable->burnItUp();
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'AttendanceRecord'){

            $modifiable = AttendanceRecord::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'MassDeduction'){

            $modifiable = MassDeduction::findOrFail($this->modifiable_id);
            $modifiable->deleteAll();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryChange'){

            $modifiable = SalaryChange::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'BankAccount'){

            $modifiable = BankAccount::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryBonus'){

            $modifiable = RecurrentSalaryBonus::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryDeduction'){

            $modifiable = RecurrentSalaryDeduction::findOrFail($this->modifiable_id);
            $modifiable->delete();

        }

        $this->active = false;
        $this->save();

        return true;
    }

    //Execute the change of modifiable to published and
    public function execute()
    {

        if(Helpers::mb_basename($this->modifiable_type) == 'Employee'){
            //Find employee and set them to published.
            $modifiable = Employee::findOrFail($this->modifiable_id);
            $modifiable->published = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeTermination'){
            //Find employeeTermination and set them to published.
            $modifiable = EmployeeTermination::findOrFail($this->modifiable_id);
            //termination task
            dispatch(new TerminateEmployee($modifiable->employee));
            //set termination status to approved
            $modifiable->active =  true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeReinstatement'){
            $modifiable = EmployeeReinstatement::findOrFail($this->modifiable_id);
            $modifiable->active = false;
            $modifiable->save();
            $employee = $modifiable->employee->reinstate();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeDeployment'){
            $modifiable = EmployeeDeployment::findOrFail($this->modifiable_id);
            $modifiable->published = true;
            $modifiable->save();
            //Update employee's deployment_status
            $employee = $modifiable->employee()->first();
            $employee->updateEngagementStatus();


        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RelieverSchedule'){
            $modifiable = RelieverSchedule::findOrFail($this->modifiable_id);
            $modifiable->published = true;
            $modifiable->save();
            //Update employee's deployment_status
            $employee = $modifiable->employee()->first();
            $employee->updateEngagementStatus();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryAdvance'){
            $modifiable = SalaryAdvance::findOrFail($this->modifiable_id);
            $modifiable->approve();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryBonus'){
            $modifiable = SalaryBonus::findOrFail($this->modifiable_id);
            $modifiable->approved = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Gear'){
            $modifiable = Gear::findOrFail($this->modifiable_id);
            $modifiable->published = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'InventoryRecord'){
            $modifiable = InventoryRecord::findOrFail($this->modifiable_id);
            $modifiable->updateStock();
            $modifiable->published = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Deduction'){

            $modifiable = Deduction::findOrFail($this->modifiable_id);
            $modifiable->processDeduction();
            $modifiable->approved = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'AttendanceRecord'){

            $modifiable = AttendanceRecord::findOrFail($this->modifiable_id);
            $modifiable->approved = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'MassDeduction'){

            $modifiable = MassDeduction::findOrFail($this->modifiable_id);
            $modifiable->approved = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryChange'){

            $modifiable = SalaryChange::findOrFail($this->modifiable_id);
            $modifiable->approved = true;
            $modifiable->processSalaryChange();
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'BankAccount'){

            $modifiable = BankAccount::findOrFail($this->modifiable_id);
            $modifiable->approved = true;
            $modifiable->save();


        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryBonus'){

            $modifiable = RecurrentSalaryBonus::findOrFail($this->modifiable_id);
            $modifiable->approved = true;
            $modifiable->save();

        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryDeduction'){

            $modifiable = RecurrentSalaryDeduction::findOrFail($this->modifiable_id);
            $modifiable->approved = true;
            $modifiable->save();

        }


        //Change status to inactive
        $this->active = false;
        $this->save();

    }

    //Approve A modification
    public function approve($reason = 'N/A'){
        //check if this user has approved this item
        if($this->uniqueApproval() || auth()->user()->can('overide-approve')){

            $approval = Approval::create([
                'modification_id'   =>  $this->id,
                'user_id'           =>  Auth::user()->id,
                'reason'            =>  $reason
            ]);

            //Check if approval threshold is reached.
            $threshold = $this->approvers_required;
            $current_count = $this->approvals()->count();

            if($current_count >= $threshold){
                //Execute action.
                $this->execute();
            }

            return true;

        }else{
            return false;
        }

    }

    public function disapprove($reason = 'N/A')
    {

        if($this->uniqueDisapproval() || auth()->user()->can('overide-approve')){
            $disapproval = Disapproval::create([
                'modification_id'   =>  $this->id,
                'user_id'           =>  Auth::user()->id,
                'reason'            =>  $reason
            ]);

            //Check if disapproval threshold is reached.
            $threshold = $this->disapprovers_required;
            $current_count = $this->disapprovals()->count();

            if($current_count >= $threshold){
                //Execute action.
                $this->nullify();
            }

            return true;

        }

        return false;

    }


    //Check if the current logged in user has approved this modification
    public function uniqueApproval()
    {

        $unique = $this->approvals()->whereUserId(Auth::user()->id)->first();

        if($unique){
            $unique = false;
        }else{
            $unique = true;
        }

        return $unique;

    }

    //Check if the current logged in user has disapproved this modification
    public function uniqueDisapproval()
    {

        $unique = $this->disapprovals()->whereUserId(Auth::user()->id)->first();

        if($unique){
            $unique = false;
        }else{
            $unique = true;
        }

        return $unique;

    }

    public function deletable()
    {
        $response = false;
        // $modifiable = 0;

        if(Helpers::mb_basename($this->modifiable_type) == 'Employee'){
            $modifiable = Employee::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeDeployment'){
            $modifiable = EmployeeDeployment::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RelieverSchedule'){
            $modifiable = RelieverSchedule::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryAdvance'){
            $modifiable = SalaryAdvance::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Gear'){
            $modifiable = Gear::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'InventoryRecord'){
            $modifiable = InventoryRecord::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeTermination'){
            $modifiable = EmployeeTermination::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'EmployeeReinstatement'){
            $modifiable = EmployeeReinstatement::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'Deduction'){
            $modifiable = Deduction::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'AttendanceRecord'){
            $modifiable = AttendanceRecord::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryBonus'){
            $modifiable = SalaryBonus::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'MassDeduction'){
            $modifiable = MassDeduction::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'SalaryChange'){
            $modifiable = SalaryChange::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'BankAccount'){
            $modifiable = BankAccount::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryBonus'){
            $modifiable = RecurrentSalaryBonus::whereId($this->modifiable_id)->count();
        }elseif(Helpers::mb_basename($this->modifiable_type) == 'RecurrentSalaryDeduction'){
            $modifiable = RecurrentSalaryDeduction::whereId($this->modifiable_id)->count();
        }

        if($modifiable < 1){
            $response = true;
        }

        return $response;

    }

    public function cleanItUp()
    {
        //Check if it is deletable
        $response = $this->deletable();

        //If condition is met, delete
        if($response){
            //Delete all related approvals and disapprovals
            foreach($this->approvals() as $approval)
            {
                $approval->delete();
            }

            foreach($this->disapprovals() as $disapproval)
            {
                $disapproval->delete();
            }
        }

        return true;
    }

    /**
     * Get the parent modifiable model
     * e.g. (Employee, EmployeeDeployment, SalaryAdvance, Gear Issuance, Employee Termination, ).
     * Retreive records by
     */
    public function modifiable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the Modification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the ModificationPayloads for the Modification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payloads(): HasMany
    {
        return $this->hasMany(ModificationPayload::class, 'modification_id', 'id');
    }

    /**
     * Get all of the Disapprovals for the Modification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disapprovals(): HasMany
    {
        return $this->hasMany(Disapproval::class, 'modification_id', 'id');
    }

    /**
     * Get all of the Approvals for the Modification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvals(): HasMany
    {
        return $this->hasMany(Approval::class, 'modification_id', 'id');
    }

}
