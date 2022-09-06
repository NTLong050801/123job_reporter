<?php


namespace Modules\Company\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;
use Illuminate\Support\Facades\Auth;
use Modules\Company\Http\Requests\InfoRequest;
use Modules\Company\Http\Requests\PasswordRequest;
use Modules\Company\Services\ProfileService;
use Workable\AuditLog\Services\ActivityService;
use Workable\AuditLog\Services\HistoryLoginService;
use function get_data_user;


class ProfileController extends AdminBaseController
{
    protected $profileService;
    protected $historyService;
    protected $activityService;

    public function __construct(ProfileService $profileService,
                                HistoryLoginService $historyService,
                                ActivityService $activityService)

    {
        $this->profileService  = $profileService;
        $this->historyService  = $historyService;
        $this->activityService = $activityService;
    }

    public function profile()
    {
        $viewData = [
            'pathAvatar' => $this->getPathAvatar()
        ];
        return view('company::pages.profile.index')->with($viewData);
    }

    public function getPathAvatar()
    {
        $path = parse_url_file(Auth::guard('admins')->user()->avatar, 'uploads');
        return $path;
    }

    public function changePassword()
    {
        return view('company::pages.profile.change_password');
    }

    public function updatePassword(PasswordRequest $request)
    {
        $email            = Auth::guard('admins')->user()->email;
        $password         = $request->get('old_password');
        $new_password     = $request->get('new_password');
        $confirm_password = $request->get('confirm_password');

        if (Auth::guard('admins')->attempt(['email' => $email, 'password' => $password])) {
            if ($new_password != $confirm_password) {
                self::message('danger', "Nhập lại mật khẩu mới không khớp");
            } else {
                $this->profileService->updatePassword(get_data_user('admins', 'id'), ['password' => $new_password]);
                self::message('info', "Cập nhật thành công");
            }
            return redirect()->back();
        } else {
            self::message('danger', "Mật khẩu không đúng");
            return redirect()->back();
        }
    }

    public function changeInfo()
    {
        return view('company::pages.profile.change_info');
    }

    public function updateInfo(InfoRequest $request)
    {
        $data = $request->except('_token');
        $this->profileService->updateInfo(get_data_user('admins', 'id'), $data);
        self::message('info', "Cập nhật thành công");
        return redirect()->back();
    }

    public function uploadAvatar(Request $request)
    {
        $this->profileService->uploadAvatar(get_data_user('admins', 'id'));
        return redirect()->route('get.profile.show');
    }

    public function history()
    {
        $filter   = [
            ['admin_id', '=', get_data_user('admins', 'id')]
        ];
        $sort     = [['id', 'desc']];
        $viewData = [
            'users' => $this->activityService->list($filter, $sort),
        ];
        return view('company::pages.profile.history')->with($viewData);
    }

    public function loginHistory()
    {
        $filter   = [
            ['admin_id', '=', get_data_user('admins', 'id')]
        ];
        $sort     = [['id', 'desc']];
        $viewData = [
            'users' => $this->historyService->list($filter, $sort),
        ];
        return view('company::pages.profile.login_history')->with($viewData);
    }
}
