<?php


/**
 * Pivot table using
 * Related post elquent
 * 
 * Laravel
 */
$post = App\Models\Post::where('slug', '=', $slug)->firstOrFail();

$related = App\Models\Post::whereHas('categories', function ($query) use ($post) {
    return $query->whereIn('posts.id', $post->categories->pluck('id')); 
})->where('posts.id', '!=', $post->id)->select('posts.*')->get();



/**
 * PHP/Laravel
 * English to Bangali Date Convert
 */
function convert_date(){
    /**
     * l = full day name (Subday)
     * F = full month name (February)
     * j = date (1)
     * Y = year 2023
     */
    $currentDate = date("l | j F Y");

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

    return str_replace($engDATE, $bangDATE, $currentDate);
}



// Validation msg in ajax - Request
protected function failedValidation(Validator $validator){
    throw new HttpResponseException(
        response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ])
    );
}

    // add code in css file with check duplicate
    echo 'hello tarek';
	$new_data = '.css{color:green}';
	//file_put_contents('test.txt', $test, FILE_APPEND | LOCK_EX);
	$file = 'test.txt';
	$contents = file_get_contents($file);
	
	if (strpos($contents, $new_data) === false) {
    // If the new data does not exist, write it to the file
		file_put_contents($file, $new_data . "\n", FILE_APPEND);
	} else {
		// If the new data already exists, do not write it to the file
		echo "Data already exists in the file.";
	}



	// Read the contents of the file into a variable
	$contents = file_get_contents($file);

	// Check if the new data already exists in the file
	if (strpos($contents, $new_data) === false) {
		// If the new data does not exist, append it to the existing data
		$merged_data = $contents . "\n" . $new_data;
	} else {
		// If the new data already exists, do not append it to the existing data
		$merged_data = $contents;
		echo "Data already exists in the file.";
	}

	// Write the merged data back to the file
	file_put_contents($file, $merged_data);


		// code replace in css file 
		$css = '.tarek { background:green !important }';
		$class = 'tarek';
		$classCss = '.tarek{color:green;background:red;}';
		
		$new_css = preg_replace('/(.*(?:\.|#)' . $class . '.*){.*}/s', '' . $classCss . '', $css);

		file_put_contents('test.css', $new_css);

		$rules = array();

		foreach ($matches[0] as $key => $match) {
			$selector = trim($matches[1][$key]);
			$declarations = trim($matches[2][$key]);

			// Create a unique key for the rule based on its selector and declarations.
			$key = md5($selector . $declarations);

			// Add the rule to the array if it doesn't already exist.
			if (!isset($rules[$key])) {
				$rules[$key] = array(
					'selector' => $selector,
					'declarations' => $declarations
				);
			}
		}

		$new_css = '';

		foreach ($rules as $rule) {
			$new_css .= $rule['selector'] . '{' . $rule['declarations'] . '}';
		}

		file_put_contents('test.css', $new_css);


		

		// Minify code 
		use MatthiasMullie\Minify;

		$id = collect(Request::segments())->last();
		$table_css = DB::table('tables')->where('table_id',$id)->select('table_class','table_css')->first();
		$file = public_path('frontend/assets/css/table.css');
	
		$contents = file_get_contents($file);
	
		// Check if the new data already exists in the file
		if (strpos($contents, $table_css->table_css) === false) {
			$merged_data = $contents . "\n" . $table_css->table_css;
		} else {
			$merged_data = $contents;
		}
		
		// Minify the CSS code
		// $minifier = new Minify\CSS($merged_data);
		// $minified_css = $minifier->minify();
	
		// Write the minified CSS code back to the same file
		file_put_contents($file, $merged_data);

		// live server write code 
		$id = collect(Request::segments())->last();
		$table_css = DB::table('tables')->where('table_id',$id)->select('table_class','table_css')->first();
		//$file = 'frontend/assets/css/table.css';
		$file = '/home/oneclicktable/public_html/frontend/assets/css/table.css';

		$contents = file_get_contents($file, FALSE);

		//dd(getcwd()); get public directory

		if (strpos($contents, $table_css->table_css) === false) {
			$merged_data = $contents . "\n" . $table_css->table_css;
			// $merged_data = preg_replace('/\s*({|}|:|;|,)\s*/', '$1', $table_css->table_css);
		} else {
			$merged_data = $contents;
		}
		file_put_contents($file, $merged_data);


// login as a user and logout 
  // admin login as a user 
Route::get('/admin/login/{userId}', [AdminLoginController::class, 'adminLoignAsUser'])->name('admin.login.as.user');
Route::get('/user/logout', [AdminLoginController::class, 'logout'])->name('user.logout');

public function adminLoignAsUser($userId)
{
	// Store the admin's ID in the session
	Session::put('admin_id', Auth::id());
	
	// Retrieve the user by ID
	$user = User::findOrFail($userId);

	// Log in the user
	Auth::login($user);

	// Redirect to the user's account page or any other desired location
	return redirect()->route('publisher.dashboard');
}

public function logout()
{
	// Log out the current user
	Auth::logout();

	// Retrieve the admin's ID from the session
	$adminId = Session::get('admin_id');

	// Log the admin back in
	Auth::loginUsingId($adminId);

	Session::forget('admin_id');
	// Redirect to the admin panel or any other desired location
	return redirect()->route('admin.dashboard');
	
}


// image convert base64 
// <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents($address->company_logo)) ?>">
 <!-- <img src="data:image/png;base64,INSERT_BASE64_DATA_HERE" alt="Your Image"> -->


 <!-- Server subdomain  -->
 <!-- file_put_contents($_SERVER['DOCUMENT_ROOT'].$image_name,$data); -->