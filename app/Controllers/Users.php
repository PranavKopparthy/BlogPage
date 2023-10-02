<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BlogModel;
use App\Models\TagModel;


class Users extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);


		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$user = $model->where('email', $this->request->getVar('email'))
											->first();

				$this->setUserSession($user);
				//$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('dashboard');

			}
		}

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');
	}

	private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function register(){
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/');

			}
		}


		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');
	}

	public function profile(){
		
		$data = [];
		helper(['form']);
		$model = new UserModel();

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				];

			if($this->request->getPost('password') != ''){
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}


			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{

				$newData = [
					'id' => session()->get('id'),
					'firstname' => $this->request->getPost('firstname'),
					'lastname' => $this->request->getPost('lastname'),
					];
					if($this->request->getPost('password') != ''){
						$newData['password'] = $this->request->getPost('password');
					}
				$model->save($newData);

				session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');

			}
		}

		$data['user'] = $model->where('id', session()->get('id'))->first();
		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');
	}

public function createBlog()
{
    $data = [];
    helper(['form']);

    // Load the TagModel
    $tagModel = new \App\Models\TagModel();

    if ($this->request->getMethod() == 'post') {
        // Form validation rules
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'tag_id' => 'required|integer', // Add validation rule for tag selection
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
        ];

        if ($this->validate($rules)) {
            $blogModel = new \App\Models\BlogModel();

            $image = $this->request->getFile('image');
            $newImageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $newImageName);

            $newBlog = [
                'title' => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
                'image' => $newImageName,
                'created_at' => date('Y-m-d H:i:s'),
                'tag_id' => $this->request->getPost('tag_id') // Get the selected tag ID
            ];

            $blogModel->insert($newBlog);

            return redirect()->to('blogs');
        } else {
            $data['validation'] = $this->validator;
        }
    }

    // Get all tags
    $data['tags'] = $tagModel->findAll();

    echo view('templates/header', $data);
    echo view('create_blog');
    echo view('templates/footer');
}


public function showBlog($id)
{
    $blogModel = new BlogModel();
    $blog = $blogModel->find($id);

    if (!$blog) {
        // Handle the case when the blog doesn't exist
        // For example, show a custom error page or redirect
        // to the blog listing page.
        // You can customize this according to your requirements.
        return redirect()->to('dashboard');
    }

    $data['blog'] = $blog;

    echo view('templates/header');
    echo view('blog', $data);
    echo view('templates/footer');
}
public function limitWords($string, $limit) {
    $words = explode(' ', $string);
    if (count($words) > $limit) {
        $words = array_slice($words, 0, $limit);
        $string = implode(' ', $words) . '...';
    }
    return $string;
}
// Display all blogs with filter dropdown
public function allBlogs()
{
    $blogModel = new \App\Models\BlogModel();
    $tagModel = new \App\Models\TagModel();

    $data['blogs'] = $blogModel->paginate(9); // Paginate the blogs with 10 blogs per page

    $tags = $tagModel->findAll();

    // Reindex the $tags array by the id field
    $data['tags'] = [];
    foreach ($tags as $tag) {
        $data['tags'][$tag['id']] = $tag;
    }

    $data['selectedTag'] = 'all'; // Default selected tag to 'all'

    $data['pager'] = $blogModel->pager; // Add the pager variable to the data

    echo view('templates/header');
    echo view('blogs', $data); // Make sure the view file name matches your actual view file
    echo view('templates/footer');
}


public function topBlogs()
{
    $data = [];

    // Fetch the top 5 most recent blogs
    $model = new BlogModel();
    $blogs = $model->orderBy('created_at', 'DESC')->findAll(5);
    $data['blogs'] = $blogs;

    echo view('templates/header', $data);
    echo view('top_blogs', $data); // Create a new view file called top_blogs.php
    echo view('templates/footer');
}

	public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}

public function filterBlogs()
{
    $tagId = $this->request->getPost('tag');

    $blogModel = new BlogModel();
    $tagModel = new TagModel();
    $data['tags'] = $tagModel->findAll();

    if ($tagId == 'all') {
        $data['blogs'] = $blogModel->findAll();
    } else {
        $data['blogs'] = $blogModel->where('tag_id', $tagId)->findAll();
    }

    // Reindex the $tags array by the id field
    $tags = $data['tags'];
    $data['tags'] = [];
    foreach ($tags as $tag) {
        $data['tags'][$tag['id']] = $tag;
    }

    $data['selectedTag'] = $tagId; // Pass the selected tag ID to the view

    echo view('templates/header');
    echo view('blogs', $data);
    echo view('templates/footer');
}





	//--------------------------------------------------------------------

}

