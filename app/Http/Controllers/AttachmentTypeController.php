<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttachmentType;
use Yajra\DataTables\DataTables;

class AttachmentTypeController extends Controller
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
            'permission:attachment_type_view' => ['index'],
            'permission:attachment_type_add' => ['create', 'store'],
            'permission:attachment_type_edit' => ['edit', 'update'],
            'permission:attachment_type_delete' => ['destroy'],
        ];
    }

    public function index()
    {
        if (request()->ajax()) {
            $attachmentTypes = AttachmentType::latest()->get();
            return DataTables::of($attachmentTypes)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $edit_url = route('attachment-types.edit', $row);
                    $delete_url = route('attachment-types.destroy', $row);
                    $csrf = csrf_token();

                    return <<<HTML
                    <form method="POST" action="$delete_url" class="d-inline-block">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="$csrf">
                        <a class="btn btn-info btn-sm m-1" href="$edit_url">
                            <i class="ri-edit-box-fill"></i>
                        </a>
                        <button type="submit" class="btn delete btn-danger btn-sm m-1">
                            <i class="ri-delete-bin-fill"></i>
                        </button>
                    </form>
                    HTML;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.attachment.typeindex');
    }

    public function create()
    {
        return view('admin.attachment.typecreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:attachment_types|max:255',
            'description' => 'nullable|string',
        ]);

        AttachmentType::create($request->all());

        return redirect()->route('attachment-types.index')->with('success', 'Attachment Type created successfully.');
    }

    public function edit(AttachmentType $attachmentType)
    {
        return view('admin.attachment.typeedit', compact('attachmentType'));
    }

    public function update(Request $request, AttachmentType $attachmentType)
    {
        $request->validate([
            'name' => 'required|string|unique:attachment_types,name,' . $attachmentType->id . '|max:255',
            'description' => 'nullable|string',
        ]);

        $attachmentType->update($request->all());

        return redirect()->route('attachment-types.index')->with('success', 'Attachment Type updated successfully.');
    }

    public function destroy(AttachmentType $attachmentType)
    {
        $attachmentType->delete();
        return redirect()->route('attachment-types.index')->with('success', 'Attachment Type deleted successfully.');
    }
}
