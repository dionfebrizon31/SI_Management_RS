<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Jobdesk;
use App\Models\Jabatans;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardAdmin extends Controller
{
    public function tambahdata(Request $request){
        $User = new User();
        if($request->role =='admins') 
        {
            $User->email = $request->email;
            $User->role = $request->role;
            $User->name = $request->name;
            
            $User->username = $request->username;
            $User->password =  Hash::make($request->password);
            $User->save();
            return redirect('/admins')->with('sukses','sukses menyimpa data admins');
        }else if($request->role =='karyawans') {
                // Validasi input
                $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:karyawans,email',
                'name' => 'required',
                'username' => 'required|string|unique:karyawans,username',
                'password' => 'required',
                'nohp' => 'required',
                'alamat' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect('/karyawans')->with('gagal','Username atau email sudah ada');
            }
            $User->email = $request->email;
            $User->name = $request->name;
            $User->username = $request->username;
            $User->role = $request->role;
            $User->password =  Hash::make($request->password);
            $User->nomorhp = $request->nohp;
            $User->alamat = $request->alamat; 
            $User->save();
            return redirect('/karyawans')->with('sukses','sukses menyimpan data karyawan');
        }  
    }
    public function editdata(Request $request,$id){ 
        $User = User::find($id);
        if($request->role =='admins'){
            // Validasi input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'username' => 'required|string|unique:users,username',
                'nohp' => 'required',
                'alamat' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect('/admins')->with('gagal','Username atau email sudah ada');
            } 
            $User->email = $request->email;
            $User->name = $request->name;
            $User->username = $request->username;
            $User->nomorhp = $request->nohp;
            $User->alamat = $request->alamat;  
            $User->save();
            return redirect('/admins')->with('sukses','sukses menyimpan data');
        }else if($request->role =='karyawans'){
             // Validasi input
             $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'username' => 'required|string|unique:users,username',
                'nohp' => 'required',
                'alamat' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect('/karyawans')->with('gagal','Username atau email sudah ada');
            } 
            $User->email = $request->email;
            $User->name = $request->name;
            $User->username = $request->username;
            $User->nomorhp = $request->nohp;
            $User->alamat = $request->alamat;    
            $User->save();
            return redirect('/karyawans')->with('sukses','sukses menyimpan data');
        }
        return 1;
     }

    public function delete($id)
    {
        try {
            $record = User::findOrFail($id);
            $record->delete();
            return response()->json(['success' => 'Record deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete record.'], 500);
        }
    }

    public function login(Request $request){
        $data = $request->only('username','password');
        
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }else{    
            return redirect()->back()->with('gagal','Username Atau Passsword Salah ');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function data(Request $request, $type, $action,$id="-1")
    {
        //type adalah nama tabel
        //action adalah tambah,edit,delete
        //id adalah id tabel database
        if($action == 'tambah'){
            return $this->keloladata($request,$type,$action,$id);
        }else if($action == 'edit'){
            return $this->keloladata($request,$type,$action,$id);
        }else if($action == 'delete'){
            return $this->keloladata($request,$type,$action,$id);
        }
        else{
            return response()->json(['status' => 'error', 'message' => 'Kode ini tidak valid.']);
        }

    }
    public function keloladata(Request $request, $type,$action,$id)
    {
        //type adalah nama tabel
        //action adalah tambah,edit,delete
        //id adalah id tabel database

        // MERUPAKAN AREA LOKASI TABLE JABATAN DI KELOLA 

        if(auth::user()->role== 'admins' && $type ==  "jabatans" && $action == "tambah") {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:jabatans,name',
            ]);
            if ($validator->fails()) {
                return redirect('/'.$type)->with('gagal','Username atau email sudah ada');
            }
            $savekan = new Jabatans();
            $savekan->name = $request->name;
            $savekan->save();
            return redirect('/'.$type)->with('sukses','sukses menyimpan data jabatan');;
        }
        else if(auth::user()->role== 'admins' && $type ==  "jabatans" && $action == "edit")
        {
            $jabatans = Jabatans::find($id);
            
            if(auth::user()->role== 'admins'){
                // Validasi input
                $validator = Validator::make($request->all(), [
               'name' => 'required',
                ]);
        
                if ($validator->fails()) {
                    return redirect('/'.$type)->with('gagal','Username atau email sudah ada');
                }
                $jabatans->name = $request->name;
                $jabatans->save();
                return redirect('/'.$type)->with('sukses','sukses menyimpan data');
            }
        }
        else if(auth::user()->role== 'admins' && $type ==  "jabatans" && $action == "delete")
        {
            try {
                 // Temukan Jabatan berdasarkan ID
                $jabatan = Jabatans::find($id);
                // Hapus record terkait di Jobdesk yang memiliki jabatans_id
                Jobdesk::where('jabatans_id', $jabatan->id)->delete();
                user::where('jabatans_id', $id)->update(['jabatans_id' => 0]);

                $jabatanlagi = Jabatans::findOrFail($id);
                // Setelah itu, hapus Jabatan
                $jabatanlagi->delete();
                
                return response()->json(['success' => 'Record deleted successfully.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to delete record.'], 500);
            }
        }

        // MERUPAKAN AREA LOKASI TABLE Karyawan DI KELOLA 

        if(auth::user()->role== 'admins' && $type ==  "karyawans" && $action == "tambah")
        {
            
            $User = new User();
            // Validasi input
            $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
            ]);
         
            if ($validator->fails()) {
                return redirect('/karyawans')->with('gagal','Username atau email sudah ada');
            }
            $User->email = $request->email;
            $User->name = $request->name;
            $User->username = $request->username;
            $User->role = $request->role;
            $User->jabatans_id = $request->jabatans;
            $User->password =  Hash::make($request->password);
            $User->nomorhp = $request->nohp;
            $User->alamat = $request->alamat; 
            $User->save();
            return redirect('/karyawans')->with('sukses','sukses menyimpan data karyawan');
         
        }
        else if(auth::user()->role== 'admins' && $type ==  "karyawans" && $action == "edit")
        {
            $User = User::find($id);rules: 
            // Validasi input
            $validator = Validator::make($request->all(), [
               'email' => 'required|email|unique:users,email',
               'name' => 'required',
               'username' => 'required|string|unique:users,username',
               'nohp' => 'required',
               'alamat' => 'required',
               'jabatans' => 'required'
            ]);
        
            if ($validator->fails()) {
                return redirect('/karyawans')->with('gagal','Username atau email sudah ada');
            } 
            $User->email = $request->email;
            $User->name = $request->name;
            $User->username = $request->username;
            $User->nomorhp = $request->nohp;
            $User->alamat = $request->alamat;    
            $User->jabatans_id = $request->jabatans;    
            $User->save();
            return redirect('/karyawans')->with('sukses','sukses menyimpan data');
        }else if(auth::user()->role== 'admins' && $type ==  "karyawans" && $action == "delete")
        {
            try {
                $record = User::findOrFail($id);
                $record->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to delete record.'], 500);
            }
        }
    
        // MERUPAKAN AREA LOKASI TABLE ADMINS DI KELOLA 

        if(auth::user()->role== 'admins' && $type ==  "admins" && $action == "tambah")
        {
            $User = new User();
            $User->email = $request->email;
            $User->name = $request->name;
            $User->role = "admins";
            $User->jabatans_id = $request->jabatans ?? null ;
            $User->username = $request->username;
            $User->password =  Hash::make($request->password);
            $User->save();
            return redirect('/admins')->with('sukses','sukses menyimpa data admins');
            
        }
        else if(auth::user()->role== 'admins' && $type ==  "admins" && $action == "edit")
        {
            $User = User::find($id);
            // Validasi input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'username' => 'required|string|unique:users,username',
                'nohp' => 'required',
                'alamat' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect('/admins')->with('gagal','Username atau email sudah ada');
            } 
            $User->email = $request->email;
            $User->name = $request->name;
            $User->username = $request->username;
            $User->nomorhp = $request->nohp;
            $User->alamat = $request->alamat;  
            $User->save();
            return redirect('/admins')->with('sukses','sukses menyimpan data');
        }
        else if(auth::user()->role== 'admins' && $type ==  "admins" && $action == "delete")
        {
            try {
                $record = User::findOrFail($id);
                $record->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to delete record.'], 500);
            }
        }
        //  area untuk jobdesk deskripsi
        if(auth::user()->role== 'admins' && $type ==  "jobdesks" && $action == "tambah") {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:jobdesks,name',
                'deskripsi' => 'required|unique:jobdesks,name',
            ]);
            if ($validator->fails()) {
                return redirect('/'.'detail-jabatan/'.$id)->with('gagal','Nama Pekerjaan Sudah ada !!');
            }
            $savekan = new Jobdesk();
            $savekan->name = $request->name;
            $savekan->jabatans_id = $id;
            $savekan->deskripsi = $request->deskripsi;
            $savekan->save();
            return redirect('/'.'detail-jabatan/'.$id)->with('sukses','sukses menyimpan data jabatan');;
        }
        else if(auth::user()->role== 'admins' && $type ==  "jobdesks" && $action == "edit")
        {
            $jobdesks = Jobdesk::find($id);
            $idjob = $request->idjob;
            if(auth::user()->role== 'admins'){
                // Validasi input
                $validator = Validator::make($request->all(), [
               'name' => 'required',
                ]);
        
                if ($validator->fails()) {
                    return redirect('/detail-jabatan/'.$idjob)->with('gagal','Username atau email sudah ada');
                }
                
                $jobdesks->name = $request->name;
                $jobdesks->deskripsi = $request->deskripsi;
                $jobdesks->save();
                return redirect('/detail-jabatan/'.$idjob)->with('sukses', 'sukses menyimpan data');
            }
        }
        else if(auth::user()->role== 'admins' && $type ==  "jobdesks" && $action == "delete")
        {
            try {
                $Jobdesk = Jobdesk::findOrFail($id);
                $Jobdesk->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to delete record.'], 500);
            }
        }

        // area untuk postingan
        if(auth::user()->role== 'admins' && $type ==  "posts" && $action == "tambah") {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'deskripsi' => 'required',
            ]);  
            if ($validator->fails()) {
               
                return redirect('/'.$type)->with('gagal','Judul Sudah Ada  !!');
            }
            $post = new Post();
            $post->title = $request->title;
            $post->slug = Str::of($request->title)->slug('-');
           
            if ($request->input('status') == true) {
                $status = "public";
            } else {
                $status = "private";
            }
   
            $post->status = $status;
            
            $post->deskripsi = $request->deskripsi;
            $post->save();
            return redirect('/'.$type)->with('sukses','sukses menyimpan data postingan');
        }
      
        else if(auth::user()->role== 'admins' && $type ==  "posts" && $action == "edit")
        {
            $post = Post::find($id);
            
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'deskripsi' => 'required',
            ]);  
            if ($validator->fails()) {
               
                return redirect('/'.$type)->with('gagal','Judul Sudah Ada  !!');
            }
         
            $post->title = $request->title;
            $post->slug = Str::of($request->title)->slug('-');
           
            if ($request->input('status') == true) {
                $status = "public";
            } else {
                $status = "private";
            }
            $post->status = $status;
            
            $post->deskripsi = $request->deskripsi;
            $post->save();
            return redirect('/'.$type)->with('sukses','sukses menyimpan data postingan');;
        }
          
        else if(auth::user()->role== 'admins' && $type ==  "posts" && $action == "delete")
        {
            try {
                $post = Post::findOrFail($id);
                $post->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to delete record.'], 500);
            }
        }



        
    }
 

}
