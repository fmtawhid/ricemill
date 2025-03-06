<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaymentsExport;
use App\Http\Controllers\Controller;
use App\Models\Bibag;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use App\Models\Purpose;
use App\Models\Sreni;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
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
            'permission:payment_view' => ['index'],
            'permission:payment_add' => ['create', 'store'],
            'permission:payment_edit' => ['edit', 'update'],
            'permission:payment_delete' => ['destroy'],
        ];
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::with('sreni', 'bibag', 'purpose')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('sreni', function ($row) {
                //     return $row->sreni->name; // Adjust based on your Sreni model
                // })
                // ->addColumn('bibag', function ($row) {
                //     return $row->bibag->name; // Adjust based on your Sreni model
                // })
                ->addColumn('sreni', function ($row) {
                return optional($row->sreni)->name ?? 'N/A';
            })
            ->addColumn('bibag', function ($row) {
                return optional($row->bibag)->name ?? 'N/A';
            })
            ->addColumn('purpose', function ($row) {
                return optional($row->purpose)->purpose_name ?? 'N/A';
            })
                ->addColumn('amount', function ($row) {
                    return $row->amount . " TK";
                })
                ->addColumn('date', function ($row) {
                    $date = $row->date ? new Carbon($row->date) : null;
                    return $date ? $date->format("d-m-Y") : 'N/A';
                })
                // ->addColumn('purpose', function ($row) {
                //     return $row->purpose->purpose_name;
                // })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('payments.destroy', $row);
                    $edit_api = route('payments.edit', $row);
                    // $seo_api = route('product_seos.create', $row->id);
                    $csrf = csrf_token();
                    $action = <<<CODE
                <form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>

                    <input name='_method' type='hidden' value='DELETE'><input name='_token' type='hidden' value='$csrf'>
                    <a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='$edit_api' data-original-title='Edit product details'>
                    <i class="ri-edit-box-fill"></i>
                    </a>

                    <button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='' data-original-title='Delete product'>
                     <i class="ri-delete-bin-fill"></i>
                    </button>
                </form>

                <button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                <i class="ri-eye-fill"></i>
                CODE;

                    return $action;
                })
                ->rawColumns(['actions', 'sreni', 'bibag'])
                ->make(true);
        }

        $srenis = Sreni::all(); // Assuming Sreni represents classes
        $bibags = Bibag::all(); // Assuming Sreni represents classes
        $purposes = Purpose::all(); // Assuming Sreni represents classes
        return view('admin.payment.index', compact('srenis', 'bibags', 'purposes'));
    }

    public function payment_report(Request $request)
    {
        // Retrieve date filters from the request
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $purpose_id = $request->input('purpose_id');

        $query = Payment::with('sreni', 'bibag', 'purpose')->latest();

        // Apply date filters if provided
        if ($fromDate && $toDate) {
            // Ensure that fromDate is before toDate
            if ($fromDate > $toDate) {
                return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
            }

            // Filter payments based on created_at date
            $query->whereDate('payments.date', '>=', $fromDate)
                ->whereDate('payments.date', '<=', $toDate);
        } elseif ($fromDate) {
            // If only fromDate is provided
            $query->whereDate('payments.date', '>=', $fromDate);
        } elseif ($toDate) {
            // If only toDate is provided
            $query->whereDate('payments.date', '<=', $toDate);
        }

        if ($purpose_id) {
            $query->where('payments.purpose_id', $purpose_id);
        }

        // Execute the query and retrieve the filtered data
        $payments = $query->get();
        if (request()->ajax()) {
            return DataTables::of($payments)
                ->addIndexColumn() // Adds a sequential index column
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('expense_head', function ($row) {
                    return $row->expense_head_name;
                })
                ->addColumn('amount', function ($row) {
                    return $row->amount . " TK";
                })
                // ->addColumn('sreni', function ($row) {
                //     return $row->sreni->name;
                // })
                // ->addColumn('bibag', function ($row) {
                //     return $row->bibag->name;
                // })
                // ->addColumn('purpose', function ($row) {
                //     return $row->purpose->purpose_name;
                // })
                ->addColumn('sreni', function ($row) {
                return optional($row->sreni)->name ?? 'N/A';
            })
            ->addColumn('bibag', function ($row) {
                return optional($row->bibag)->name ?? 'N/A';
            })
            ->addColumn('purpose', function ($row) {
                return optional($row->purpose)->purpose_name ?? 'N/A';
            })
                ->addColumn('date', function ($row) {
                    $date = $row->date ? new Carbon($row->date) : null;
                    return $date ? $date->format("d-m-Y") : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('payments.destroy', $row);
                    $edit_api = route('payments.edit', $row);
                    $csrf = csrf_token();
                    $action = <<<CODE
                <form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>

                    <input name='_method' type='hidden' value='DELETE'><input name='_token' type='hidden' value='$csrf'>
                    <a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='$edit_api' data-original-title='Edit product details'>
                    <i class="ri-edit-box-fill"></i>
                    </a>

                    <button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='' data-original-title='Delete product'>
                     <i class="ri-delete-bin-fill"></i>
                    </button>
                </form>

                 <button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                    <i class="ri-eye-fill"></i>
                </button>

                CODE;

                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions', 'expense_head'])
                ->make(true);
        }

        $srenis = Sreni::all(); // Assuming Sreni represents classes
        $bibags = Bibag::all(); // Assuming Sreni represents classes
        $purposes = Purpose::all(); // Assuming Sreni represents classes


        // Return the view with expenses and expense heads data
        return view('admin.payment.payments_report', compact('srenis', 'bibags', 'purposes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reciept_no' => 'required|unique:payments,reciept_no',
            'date' => 'required|date_format:d-m-Y',
            'name' => 'required|string|max:255',
            'dhakila_number' => 'required|integer',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'amount_in_words' => 'required|string|max:255',
            'sreni_id' => 'required|exists:srenis,id',
            'bibag_id' => 'required|exists:bibags,id',
            'purpose_id' => 'required|exists:purposes,id',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // 512 KB
            // 'amount_in_words' will be handled server-side
        ]);

        $payment =  Payment::create([
            'reciept_no' => $request->reciept_no,
            'date' => Carbon::createFromFormat('d-m-Y', $request->date),
            'name' => $request->name,
            'dhakila_number' => $request->dhakila_number,
            'address' => $request->address,
            'purpose_id' => $request->purpose_id,
            'amount' => $request->amount,
            'amount_in_words' => $request->amount_in_words,
            'sreni_id' => $request->sreni_id,
            'bibag_id' => $request->bibag_id,
        ]);

        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');

            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                PaymentAttachment::create([
                    'payment_id' => $payment->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $fileNameToStore,
                    'file_type' => $extension, // Add this field to the database
                ]);
            }
        }

        return response()->json(['success' => "Payment created Successfully"]);
    }

    public function edit(Payment $payment)
    {
        $srenis = Sreni::all();
        $bibags = Bibag::all();
        $purposes = Purpose::all();
        $attachments = $payment->attachments()->get();
        return view('admin.payment.edit', compact('payment', 'srenis', 'bibags', 'purposes', 'attachments'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        // Validate the request
        $request->validate([
            'reciept_no' => 'required|unique:payments,reciept_no,' . $payment->id,
            'date' => 'required|date_format:d-m-Y',
            'name' => 'required|string|max:255',
            'dhakila_number' => 'required|integer',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'sreni_id' => 'required|exists:srenis,id',
            'bibag_id' => 'required|exists:bibags,id',
            'purpose_id' => 'required|exists:purposes,id',
            'amount_in_words' => 'required|string|max:255',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // 512 KB
            'delete_attachments' => 'array', // IDs of attachments to delete
            'delete_attachments.*' => 'integer|exists:payment_attachments,id',
            // 'amount_in_words' will be handled server-side
        ]);

        // Update student data
        $payment->reciept_no = $request->reciept_no;
        $payment->date = Carbon::createFromFormat('d-m-Y', $request->date);
        $payment->name = $request->name;
        $payment->dhakila_number = $request->dhakila_number;
        $payment->address = $request->address;
        $payment->amount = $request->amount;
        $payment->sreni_id = $request->sreni_id;
        $payment->bibag_id = $request->bibag_id;
        $payment->purpose_id = $request->purpose_id;
        $payment->amount_in_words = $request->amount_in_words;

        $payment->save();

        // Handle deletion of attachments
        if ($request->has('delete_attachments')) {
            $attachmentsToDelete = PaymentAttachment::whereIn('id', $request->delete_attachments)->get();

            foreach ($attachmentsToDelete as $attachment) {
                // Delete the file from storage
                if (file_exists(public_path('assets/attachements/' . $attachment->file_path))) {
                    unlink(public_path('assets/attachements/' . $attachment->file_path));
                }

                // Delete the record from database
                $attachment->delete();
            }
        }

        // Handle new attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                PaymentAttachment::create([
                    'payment_id' => $payment->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $filenameWithExt,
                    'file_type' => $extension
                ]);
            }
        }


        return response()->json(['success' => "Payment updated successfully"]);
    }

    public function destroy(Payment $payment)
    {

        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }



    // public function exportExcel(Request $request)
    // {
    //     $request->validate([
    //         'from_date' => 'nullable|date',
    //         'to_date' => 'nullable|date|after_or_equal:from_date',
    //     ], [
    //         'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
    //     ]);

    //     $fromDate = $request->input('from_date');
    //     $toDate = $request->input('to_date');
    //     $purpose_id = $request->input('purpose_id'); // ✅ Include purpose_id


    //     // Format for the filename to include date range
    //     $filename = 'payment';
    //     if ($fromDate && $toDate) {
    //         $filename .= '_from_' . $fromDate . '_to_' . $toDate;
    //     } elseif ($fromDate) {
    //         $filename .= '_from_' . $fromDate;
    //     } elseif ($toDate) {
    //         $filename .= '_to_' . $toDate;
    //     }
    //     $filename .= '.xlsx';

    //     return Excel::download(new PaymentsExport($fromDate, $toDate), $filename);
    // }

    // // Export to PDF
    // public function exportPDF(Request $request)
    // {
    //     $request->validate([
    //         'from_date' => 'nullable|date',
    //         'to_date' => 'nullable|date|after_or_equal:from_date',
    //     ], [
    //         'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
    //     ]);
    //     $fromDate = $request->input('from_date');
    //     $toDate = $request->input('to_date');
    //     $purpose_id = $request->input('purpose_id'); // ✅ Include purpose_id


    //     // Build the query with necessary joins and filters
    //     $query = Payment::with('sreni', 'bibag')->latest();

    //     // Apply date filters using `when()`
    //     $query->when($fromDate, function ($q, $fromDate) {
    //         return $q->whereDate('payments.created_at', '>=', $fromDate);
    //     })
    //         ->when($toDate, function ($q, $toDate) {
    //             return $q->whereDate('payments.created_at', '<=', $toDate);
    //         });

    //     $payments = $query->get();

    //     // Format for the filename to include date range
    //     $filename = 'payment';
    //     if ($fromDate && $toDate) {
    //         $filename .= '_from_' . $fromDate . '_to_' . $toDate;
    //     } elseif ($fromDate) {
    //         $filename .= '_from_' . $fromDate;
    //     } elseif ($toDate) {
    //         $filename .= '_to_' . $toDate;
    //     }
    //     $filename .= '.pdf';

    //     $pdf = Pdf::loadView('admin.payment.export_pdf', [
    //         'payments' => $payments,
    //         'fromDate' => $fromDate,
    //         'toDate' => $toDate,
    //     ])->setPaper('a4', 'landscape');

    //     return $pdf->download($filename);
    // }
    public function exportExcel(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'purpose_id' => 'nullable|exists:purposes,id', // purpose_id validation
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        // Get input values
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : null;
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : null;
        $purposeId = $request->input('purpose_id');

        // Format for the filename to include date range
        $filename = 'payment';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y') . '_to_' . $toDate->format('d-m-Y');
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y');
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate->format('d-m-Y');
        }
        $filename .= '.xlsx';

        return Excel::download(new PaymentsExport($fromDate, $toDate, $purposeId), $filename);
    }

    // Export to PDF
    public function exportPDF(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'purpose_id' => 'nullable|exists:purposes,id', // purpose_id validation
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        // Get input values
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : null;
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : null;
        $purposeId = $request->input('purpose_id');

        // Build the query with necessary joins and filters
        $query = Payment::with('sreni', 'bibag')->latest();

        // Apply date filters using `when()`
        $query->when($fromDate, function ($q, $fromDate) {
            return $q->whereDate('payments.created_at', '>=', $fromDate);
        })
        ->when($toDate, function ($q, $toDate) {
            return $q->whereDate('payments.created_at', '<=', $toDate);
        });

        // Apply purpose filter if provided
        if ($purposeId) {
            $query->where('payments.purpose_id', $purposeId);
        }

        $payments = $query->get();

        // Format for the filename to include date range
        $filename = 'payment';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y') . '_to_' . $toDate->format('d-m-Y');
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y');
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate->format('d-m-Y');
        }
        $filename .= '.pdf';

        $pdf = Pdf::loadView('admin.payment.export_pdf', [
            'payments' => $payments,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }


    public function getAttachments(Payment $payment)
    {
        $attachments = $payment->attachments()->get(['file_path', 'file_name', 'file_type']);

        // Generate URLs for the attachments
        $attachments = $attachments->map(function ($attachment) {
            return [
                'url' => asset('assets/attachements/' . $attachment->file_path),
                'name' => $attachment->file_name,
                'file_type' => $attachment->file_type
            ];
        });

        return response()->json(['attachments' => $attachments]);
    }
}
