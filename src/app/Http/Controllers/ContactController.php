<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    public function index(){
        return view ('index');
    }

    public function confirm(ContactRequest $request){
        $contact = $request->only([
            'category_id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'select',
            'detail'
        ]);
        return view('confirm',compact('contact'));
    }

    public function store(ContactRequest $request){
        $contact = $request->only([
            'category_id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail'
        ]);
        Contact::create($contact);
        return view('thanks');
    }

    public function back(Request $request){
    // 入力データを old() にセットして index.blade.php に戻す
    return redirect('/')->withInput($request->all());
    }

    public function admin(Request $request){
    $filters = $request->only(['keyword','gender','content','date']);

    $contacts = Contact::with('category')
        ->filter($filters)
        ->orderByDesc('created_at')
        ->paginate(7)
        ->withQueryString();

    // ① ?modal=ID を拾う
    $openId = (int) $request->input('modal');

    // ② その1件だけ取得（なければ null）
    $openContact = $openId ? Contact::with('category')->find($openId) : null;

    // ③ “今のページに見えている行”以外のIDだったら開かない（任意のガード）
    if ($openContact && !$contacts->getCollection()->contains('id', $openId)) {
        $openContact = null;
    }

    return view('admin', compact('contacts','openContact'));
    }


    public function destroy(Contact $contact){
    $contact->delete();
    return redirect('admin');
    }

    public function export(Request $request): StreamedResponse {
    // 画面の検索条件をそのまま適用
    $filters  = $request->only(['keyword','gender','content','date']);
    $fileName = 'contacts_'.now()->format('Ymd_His').'.csv';

    // 一覧と同じ条件で取得（カテゴリ情報も一緒に）
    $base = Contact::with('category')
        ->filter($filters)
        ->orderBy('id'); // chunkByIdに備えて昇順

    $headers = [
        'Content-Type'        => 'text/csv; charset=UTF-8',
        'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
    ];

    return response()->streamDownload(function () use ($base) {
        $out = fopen('php://output', 'w');

        // Excel文字化け対策：UTF-8 BOM
        fwrite($out, "\xEF\xBB\xBF");

        // 見出し行（必要に応じて列を増減）
        fputcsv($out, ['ID','お名前','性別','メールアドレス','お問い合わせの種類','作成日']);

        // 大量データでも安定して出力
        $base->chunkById(1000, function ($rows) use ($out) {
            foreach ($rows as $r) {
                $genderLabel = $r->gender == 1 ? '男性' : ($r->gender == 2 ? '女性' : 'その他');
                $fullName    = trim(($r->last_name ?? '').' '.($r->first_name ?? ''));
                $category    = $r->category->content ?? '';

                fputcsv($out, [
                    $r->id,
                    $fullName,
                    $genderLabel,
                    $r->email,
                    $category,
                    optional($r->created_at)->format('Y-m-d H:i:s'),
                ]);
            }
            fflush($out); // こまめにフラッシュ
        });

        fclose($out);
    }, $fileName, $headers);
}

}
