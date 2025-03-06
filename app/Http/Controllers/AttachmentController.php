<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Attachment;
use App\Models\AttachmentType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttachmentController extends Controller
{
    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    public static function middlewareList(): array
    {
        return [
            'permission:attachment_view' => ['index'],
            'permission:attachment_add' => ['create', 'store'],
            'permission:attachment_edit' => ['edit', 'update'],
            'permission:attachment_delete' => ['destroy'],
        ];
    }

    public function index()
    {
        // Eager load the attachmentType relationship
        $attachments = Attachment::with('attachmentType')->latest()->get();

        if (request()->ajax()) {
            return DataTables::of($attachments)
                ->addIndexColumn()
                ->addColumn('attachment_type_name', function ($row) {
                    return $row->attachmentType ? $row->attachmentType->name : 'N/A'; // Check if exists
                })
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('attachments.destroy', $row);
                    $edit_api = route('attachments.edit', $row);
                    $csrf = csrf_token();
                    return <<<HTML
                    <form method='POST' action='$delete_api' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>
                        <a class='btn btn-info btn-sm m-1' href='$edit_api'>
                            <i class="ri-edit-box-fill"></i>
                        </a>
                        <button type='submit' class='btn delete btn-danger btn-sm m-1'>
                            <i class="ri-delete-bin-fill"></i>
                        </button>
                    </form>
                    HTML;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.attachment.index', compact('attachments'));
    }
    public function create()
    {
        $attachmentTypes = AttachmentType::all();
        return view('admin.attachment.create', compact('attachmentTypes'));
    }

    public function store(Request $request)
    {
        try {
            // ইনপুট ভ্যালিডেশন
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'date' => 'required|date',
                'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
                'attachment_type_id' => 'required|exists:attachment_types,id',
            ]);

            $attachment = new Attachment();
            $attachment->title = $request->title;
            $attachment->description = $request->description;
            $attachment->date = Carbon::createFromFormat('d-m-Y', $request->date);
            $attachment->attachment_type_id = $request->attachment_type_id;

            // PDF ফাইল আপলোড করা
            if ($request->hasFile('pdf_file')) {
                $pdfFile = $request->file('pdf_file');
                $pdfFilePath = time() . '.' . $pdfFile->extension();
                $pdfFile->move(public_path('img/attachment_pdf'), $pdfFilePath);

                // এখানে পাথ সংরক্ষণ করতে হবে
                $attachment->pdf_file = 'img/attachment_pdf/' . $pdfFilePath;
            }

            $attachment->save();

            return redirect()->route('attachments.index')->with('success', 'Attachment created successfully');
        } catch (\Exception $e) {
            // এক্সেপশন হ্যান্ডলিং
            return back()->with('error', 'Something went wrong. Please try again. Error: ' . $e->getMessage());
        }
    }


    // Attachment দেখানো (যদি প্রয়োজন হয়)
    public function show($id)
    {
        $attachment = Attachment::findOrFail($id);
        return view('admin.attachment.show', compact('attachment'));
    }

    // Attachment আপডেট করার ফর্ম
    public function edit($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachmentTypes = AttachmentType::all();  // সব attachment type
        return view('admin.attachment.edit', compact('attachment', 'attachmentTypes'));
    }

    // Attachment আপডেট করা
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
            'attachment_type_id' => 'required|exists:attachment_types,id',
        ]);

        $attachment = Attachment::findOrFail($id);
        $attachment->title = $request->title;
        $attachment->description = $request->description;
        $attachment->date = Carbon::createFromFormat('d-m-Y', $request->date);
        $attachment->attachment_type_id = $request->attachment_type_id;

        // PDF ফাইল আপলোড করা
            if ($request->hasFile('pdf_file')) {
                $pdfFile = $request->file('pdf_file');
                $pdfFilePath = time() . '.' . $pdfFile->extension();
                $pdfFile->move(public_path('img/attachment_pdf'), $pdfFilePath);

                // এখানে পাথ সংরক্ষণ করতে হবে
                $attachment->pdf_file = 'img/attachment_pdf/' . $pdfFilePath;
            }

        $attachment->save();

        return redirect()->route('attachments.index')->with('success', 'Attachment updated successfully');
    }

    // Attachment ডিলিট করা
    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->delete();

        return redirect()->route('attachments.index')->with('success', 'Attachment deleted successfully');
    }
}
