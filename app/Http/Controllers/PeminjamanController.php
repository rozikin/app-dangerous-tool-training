<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use App\Exports\PeminjamanExport;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function Allpeminjaman(Request $request)
    {   

        return view('dangerous.all_transaction');
    } 

    public function getpeminjaman(Request $request)
    {
        if ($request->ajax()) {
            $data = Peminjaman::with(['employee', 'item'])
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->latest()
                    ->get();
            return Datatables::of($data)
      
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return   '<div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-center">
                          
                            <div class="d-flex align-items-center">
                                <div class="actions dropdown">
                                    <a href="#" data-bs-toggle="dropdown"> ••• </a>
                                    <div class="dropdown-menu" role="menu">
                                      
                                    
                                            <a href="javascript:void(0)"
                                                class="dropdown-item editItem" data-id="'.$row->id.'"> &nbsp; Edit</a>
                                     
                            
                                            <a href="javascript:void(0)"
                                                class="dropdown-item text-danger deleteItem"
                                             data-id="'.$row->id.'"> &nbsp; Delete</a>
                                     
  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function getpeminjamanoke(Request $request)
    {
      // Retrieve start and end dates from the request
    $startDate = $request->start_date;
    $endDate = $request->end_date;

    // Validate if start and end dates are in correct format
    try {
        $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();
        $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid date format.'], 400);
    }

    // Fetch data from the database based on the date range
    $borrowings = Peminjaman::whereBetween('created_at', [$startDate, $endDate])->get();

      


      

       // Render HTML for the table rows
       $html = '';
       foreach ($borrowings as $index => $borrowing) {
           $html .= '<tr>';
           $html .= '<td>' . ($index + 1) . '</td>';
           $html .= '<td>' . $borrowing->trx_out . '</td>';
           $html .= '<td>' . $borrowing->date_in . '</td>';
           $html .= '<td>' . $borrowing->nik . '</td>';
           $html .= '<td>' . $borrowing->name . '</td>';
           $html .= '<td>' . $borrowing->department . '</td>';
           $html .= '<td>' . $borrowing->trx_return . '</td>';
           $html .= '<td>' . $borrowing->sku . '</td>';
           $html .= '<td>' . $borrowing->item_name . '</td>';
           $html .= '<td>' . $borrowing->date_out . '</td>';
           $html .= '<td>' . $borrowing->remark . '</td>';
           $html .= '<td><!-- Action buttons, if any --></td>';
           $html .= '</tr>';
       }

       // Return the HTML content
       return $html;
    }

    public function GetPeminjamanlimit(){
        $transactions = Peminjaman::with('employee', 'item')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($transactions);
    }

    public function Addpeminjaman(){
        return view('dangerous.peminjaman');
    }   
    public function Addpeminjamanrt(){
        return view('dangerous.pengembalian');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function StorePeminjaman(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'item_id' => 'required',
        ]);

        // Generate no_trx_out
        $lastTransactionOut = Peminjaman::whereNotNull('no_trx_out')
            ->orderBy('created_at', 'desc')
            ->first();
        if ($lastTransactionOut) {
            $lastNoTrxOut = $lastTransactionOut->no_trx_out;
            $lastNoTrxOutNum = intval(substr($lastNoTrxOut, 8));
            $nextNoTrxOutNum = $lastNoTrxOutNum + 1;
        } else {
            $nextNoTrxOutNum = 1;
        }
        $noTrxOut = 'TRX-OUT' . sprintf('%06d', $nextNoTrxOutNum);

        // Generate no_trx_return
        $lastTransactionReturn = Peminjaman::whereNotNull('no_trx_return')
            ->orderBy('no_trx_return', 'desc')
            ->first();
            // dd($lastTransactionReturn);
        if ($lastTransactionReturn) {
            $lastNoTrxReturn = $lastTransactionReturn->no_trx_return;
            $lastNoTrxReturnNum = intval(substr($lastNoTrxReturn, 8));
            $nextNoTrxReturnNum = $lastNoTrxReturnNum + 1;
        } else {
            $nextNoTrxReturnNum = 1;
        }
        $noTrxReturn = 'TRX-RTN' . sprintf('%06d', $nextNoTrxReturnNum);
        

        if ($request->remark == "PINJAM") {
            // Check item status
            $item = Item::find($request->item_id);
            if ($item && $item->status == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item sedang dipinjam!',
                    'alert-type' => 'error'
                ]);
            }

      

            // Create new transaction
            $transaction = Peminjaman::create([
                'no_trx_out' => $noTrxOut,
                'employee_id' => $request->employee_id,
                'item_id' => $request->item_id,
                'no_trx_return' => '',
                'remark' => 'PINJAM'
            ]);

           // Update item status to 1 (borrowed)
           if($transaction){

            if ($item) {
                $item->status = 1;
                $item->save();
            }

           }
        

        } elseif ($request->remark == "KEMBALI") {
            // Find the last PINJAM transaction for this item and employee
            $transaction = Peminjaman::where('employee_id', $request->employee_id)
                ->where('item_id', $request->item_id)
                ->where('remark', 'PINJAM')
                ->latest('id')
                ->first();

            if ($transaction) {
                // Update the transaction with return details

            
                $transaction->update([
                    'no_trx_return' => $noTrxReturn,
                    'remark' => 'KEMBALI'
                ]);


                // Update item status to 0 (available)
                $item = Item::find($request->item_id);
                if ($item) {
                    $item->status = 0;
                    $item->save();
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada transaksi PINJAM yang sesuai ditemukan untuk dikembalikan!',
                    'alert-type' => 'error'
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan!',
            'data' => $transaction,
            'alert-type' => 'success'
        ]);
    }

    public function StorePeminjamanold1(Request $request)
    {
        $request->validate([
            'employee_id' => 'required', // Validasi bahwa employee_id diharapkan dari request
            'item_id' => 'required', // Validasi bahwa employee_id diharapkan dari request
        ]);

        // Membuat nomor transaksi
        $lastTransaction = Peminjaman::orderBy('created_at', 'desc')->first();
        if ($lastTransaction) {
            $lastNoTrx = $lastTransaction->no_trx_out;
            $lastNoTrxNum = intval(substr($lastNoTrx, 8)); // Get the numeric part of the last transaction number
            $nextNoTrxNum = $lastNoTrxNum + 1; // Increment the number
        } else {
            $nextNoTrxNum = 1; // Start with 1 if there are no transactions
        }
        $noTrx = 'TRX-OUT' . sprintf('%06d', $nextNoTrxNum);

        $lastTransactionReturn = Peminjaman::orderBy('created_at', 'desc')->first();
        if ($lastTransactionReturn) {
            $lastNoTrxReturn = $lastTransactionReturn->no_trx_return;
            $lastNoTrxReturnNum = intval(substr($lastNoTrxReturn, 8)); // Get the numeric part of the last return transaction number
            $nextNoTrxReturnNum = $lastNoTrxReturnNum + 1; // Increment the number
        } else {
            $nextNoTrxReturnNum = 1; // Start with 1 if there are no transactions
        }
        $noTrxReturn = 'TRX-RTN' . sprintf('%06d', $nextNoTrxReturnNum);
            


        
        if ($request->remark == "PINJAM") {

             // Check the status of the item
            $item = Item::find($request->item_id);
            if ($item && $item->status == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status masih PINJAM!',
                    'alert-type' => 'error'
                ]);
            }


            // Periksa apakah sudah ada transaksi IN yang belum di-close dengan OUT untuk employee_id yang sama
            $existingTransaction = Peminjaman::where('employee_id', $request->employee_id)
                                            ->where('item_id', $request->item_id)
                                            ->where('remark', 'PINJAM')
                                            ->first();
            if ($existingTransaction) {
                // Jika ada, kirim response gagal untuk menghindari duplikasi
                return response()->json([
                    'success' => false,
                    'message' => 'Status masih PINJAM!',
                    'alert-type' => 'error'
                ]);
            }

            // Jika tidak ada transaksi IN yang terbuka, buat transaksi baru
            $transaction = Peminjaman::create([
                'no_trx_out' => $noTrx,
                'employee_id' => $request->employee_id,
                'item_id' => $request->item_id,
                'no_trx_return' => '',
                'remark' => 'PINJAM'
            ]);

                // Update item status to 0 (false)
            $item = Item::find($request->item_id);
            if ($item) {
                $item->update(['status' => 0]);
            }


        } elseif ($request->remark == "KEMBALI") {
            // Jika types adalah OUT, update transaksi terakhir dengan status IN dan employee_id yang sama
            $transaction = Peminjaman::where('employee_id', $request->employee_id)
                                    ->where('item_id', $request->item_id)
                                    ->where('remark', 'PINJAM')
                                    ->latest('id')
                                    ->first();

            if ($transaction) {
                // Update transaksi yang ditemukan dengan OUT
                $transaction->update([
                    'no_trx_return' => $noTrxReturn,
                    'remark' => 'KEMBALI'
                ]);


                    // Update item status to 1 (true) when returned
                $item = Item::find($request->item_id);
                if ($item) {
                    $item->update(['status' => 1]);
                }



            } else {
                // Jika tidak ditemukan transaksi yang bisa diupdate, kirim error response
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada transaksi IN yang sesuai ditemukan untuk diupdate!',
                    'alert-type' => 'error'
                ]);
            }
        }

        // Kirim response sukses jika semua proses di atas berjalan tanpa error
        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan!',
            'data' => $transaction,
            'alert-type' => 'success'
        ]);

    }
    

            
    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }

    public function Deletepeminjaman($id)
    {
        $del = Peminjaman::findOrFail($id);

        $item = Item::find($del->item_id);
    
        if ($item) {
            // Perbarui status item menjadi 0
            $item->status = 0;
            $item->save();
        }

        // Hapus transaksi
        $del->delete();
       

        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]);

    }

    public function export(Request $request)
    {
        $export = new PeminjamanExport($startDate, $endDate);

        return Excel::download($export, 'peminjaman.xlsx');
    }
}
