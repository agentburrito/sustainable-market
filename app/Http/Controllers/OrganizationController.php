<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function edit(Organization $organization) 
    {    
        return view('organizations.edit', compact('organization'));
    
    }

    public function show(Organization $organization)
    {
        return view('organizations.show', compact('organization'));
    }

    public function update(Organization $organization, Request $request) 
    {
        $this->validate($request, [
            'name' => 'required', 
            'description' => 'required'
        ]);

        $organization->update([
            'name' => $request->get('name'), 
            'description' => $request->get('description')
        ]);
        
        return redirect()->back()->withSuccess('Organization details have been updated successfully!');
    }
}
