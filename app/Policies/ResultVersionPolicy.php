<?php

namespace App\Policies;

use App\Models\ReportVersion;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Auth\Access\Response;

class ResultVersionPolicy
{
    /**
     * Helper method to get user role
     */
    protected function getUserRole($user)
    {
        // If user is Employee model
        if ($user instanceof Employee) {
            return $user->role ?? null;
        }
        
        // If user has role attribute
        if (isset($user->role)) {
            return $user->role;
        }
        
        // Default role check (you may need to adjust based on your auth setup)
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        $role = $this->getUserRole($user);
        return in_array($role, ['Chemist', 'Lab Manager', 'QA', 'Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        
        // Chemist can see everything including Draft
        if ($role === 'Chemist' || $role === 'Super Admin') {
            return true;
        }
        
        // Other roles can see everything except Draft
        return $reportVersion->report_status !== 'draft';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        $role = $this->getUserRole($user);
        return in_array($role, ['Chemist', 'Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        
        // Only draft can be edited
        if (!$reportVersion->isDraft()) {
            return false;
        }
        
        // Only Chemist/Admin can edit
        return in_array($role, ['Chemist', 'Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        
        // Only draft can be deleted
        if (!$reportVersion->isDraft()) {
            return false;
        }
        
        // Only Chemist/Admin can delete
        return in_array($role, ['Chemist', 'Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can submit for review.
     */
    public function submitReview($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        
        // Only draft can be submitted
        if (!$reportVersion->isDraft()) {
            return false;
        }
        
        // Only Chemist can submit
        return $role === 'Chemist' || $role === 'Super Admin';
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function approve($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        
        // Only review status can be approved
        if (!$reportVersion->isReview()) {
            return false;
        }
        
        // Only non-Chemist roles can approve
        return in_array($role, ['Lab Manager', 'QA', 'Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can reject the model.
     */
    public function reject($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        
        // Only review status can be rejected
        if (!$reportVersion->isReview()) {
            return false;
        }
        
        // Only non-Chemist roles can reject
        return in_array($role, ['Lab Manager', 'QA', 'Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can generate report.
     */
    public function generateReport($user, ReportVersion $reportVersion): bool
    {
        // Only approved versions can generate reports
        if (!$reportVersion->isApproved()) {
            return false;
        }
        
        $role = $this->getUserRole($user);
        return in_array($role, ['Chemist', 'Lab Manager', 'QA', 'Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        return in_array($role, ['Admin', 'Super Admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, ReportVersion $reportVersion): bool
    {
        $role = $this->getUserRole($user);
        return $role === 'Super Admin';
    }
}
