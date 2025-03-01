<?php
namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\Controller;
class ChatGPTController extends Controller
{
/**
* Write code on Method
*
* @return response()
*/
public function index(Request $request)
{
$result = '';
if ($request->filled('title')) {
$messages = [
['role' => 'user', 'content' => 'suggest me a news article about "'.$request->title.'" topics. simply give me 3 paragraph article new. '],
];
$result = OpenAI::chat()->create([
'model' => 'gpt-3.5-turbo',
'messages' => $messages,
]);
$result = Arr::get($result, 'choices.0.message')['content'] ?? '';
}
return view('back.chatGPT.index', compact('result'));
}
}
