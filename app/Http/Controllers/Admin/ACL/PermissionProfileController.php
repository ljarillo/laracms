<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    /**
     * @param Profile $profile
     * @param Permission $permission
     */
    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

//        $this->middleware(['can:profiles']);
    }

    /**
     * @param $idProfile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function permissions($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.profiles.profiles', [
            'profile' => $profile,
            'profiles' => $permissions
        ]);
    }

    /**
     * @param $idPermission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function profiles($idPermission)
    {
        if(!$permission = $this->permission->find($idPermission)){
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.profiles.profiles.profiles', [
            'permission' => $permission,
            'profiles' => $profiles
        ]);
    }

    /**
     * @param Request $request
     * @param $idProfile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function permissionsAvailable(Request $request, $idProfile)
    {
        if(!$profile= $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.profiles.available', [
            'profile' => $profile,
            'profiles' => $permissions,
            'filters' => $filters
        ]);
    }

    /**
     * @param Request $request
     * @param $idProfile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos uma permissão');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()
            ->route('profiles.profiles', $profile->id)
            ->with('message', 'Atribuida as permissões com sucesso');
    }

    /**
     * @param $idProfile
     * @param $idPermission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detachPermissionsProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);
        if(!$profile || !$permission){
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()
            ->route('profiles.profiles', $profile->id)
            ->with('message', "Desvinculada a permissão {$permission->name} do perfil {$profile->name}");
    }
}
