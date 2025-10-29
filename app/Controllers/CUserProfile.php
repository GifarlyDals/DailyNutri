<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Muser;

class CUserProfile extends BaseController
{
    public function index()
    {

        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id = session()->get('idUser');
        $Muser = new Muser();
        $data['user'] = $Muser->getById($id);

        return view('dashboardUser/profile', $data);
    }

    public function update($idUser)
    {
        $Muser = new Muser();

        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validasi
        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => 'required|valid_email',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Cek email unik
        $existing = $Muser->where('email', $email)
                        ->where('idUser !=', $idUser)
                        ->first();

        if ($existing) {
            session()->setFlashdata('error', 'Email sudah digunakan oleh user lain.');
            return redirect()->back()->withInput();
        }

        // ✅ Update data dasar (TANPA PASSWORD!)
        $updateData = [
            'username' => $username,
            'email'    => $email
        ];

        // ✅ Update password hanya jika ada isinya
        if (!empty($password)) {
            if (strlen($password) < 6) {
                session()->setFlashdata('error', 'Password minimal 6 karakter.');
                return redirect()->back()->withInput();
            }
            $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        // ✅ Handle upload foto
        $file = $this->request->getFile('photo');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (! in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
                session()->setFlashdata('error', 'Format foto harus JPG/PNG/WEBP.');
                return redirect()->back()->withInput();
            }

            if ($file->getSize() > 2 * 1024 * 1024) {
                session()->setFlashdata('error', 'Ukuran foto maksimal 2MB.');
                return redirect()->back()->withInput();
            }

            $uploadPath = FCPATH . 'uploads/profile/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Hapus foto lama
            $old = $Muser->find($idUser);
            if (!empty($old['profilPict'])) {
                $oldPath = $uploadPath . $old['profilPict'];
                if (is_file($oldPath)) @unlink($oldPath);
            }

            // Upload baru
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $updateData['profilPict'] = $newName;
        }

        // ✅ Update DB
        $Muser->update($idUser, $updateData);

        // ✅ Update session
        session()->set('username', $username);
        session()->set('email', $email);

        session()->setFlashdata('success', 'Profil berhasil diperbarui!');
        return redirect()->to('/editprofile');
    }


}
