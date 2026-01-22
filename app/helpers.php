<?php
// use Jenssegers\Agent\Facades\Agent;
use App\Customers;
use Carbon\Carbon;
use App\Models\Tax;
use App\Models\Item;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\Unit;
use App\Models\User;
use App\Models\Asset;
use App\Models\Stock;
use App\Models\Budget;
use App\Models\Quotes;
use App\Models\Region;
use App\Models\Account;
use App\Models\Booking;
use App\Models\Classes;
use App\Models\Company;
use App\Models\Journal;
use App\Models\Pincard;
use App\Models\Receipt;
use App\Models\Cashbook;
use App\Models\Category;
use App\Models\Province;
use App\Models\Continent;
use App\Models\Repayment;
use App\Models\MemberLoan;
use App\Models\Beneficiary;
use App\Models\Requisition;
use App\Models\SaleInvoice;
use App\Models\SalesOrders;
use App\Models\SubCategory;
use App\Models\TempJournal;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\CashMovement;
use App\Models\ExchangeRate;
use App\Models\Payable_Type;
use App\Models\Payment_Bank;
use App\Models\AuditProvince;
use App\Models\BankStatement;
use App\Models\MemberSavings;
use App\Models\NominalLedger;
use App\Models\PurchaseOrder;
use App\Models\ReconCashbook;
use App\Models\TempCashbooks;
use App\Models\AllTransaction;
use App\Models\BookingExpense;
use App\Models\BookingPayment;
use App\Models\GeneralInvoice;
// use App\Models\ReceivableType;
use App\Models\MyTransactions;
use App\Models\PaymentVoucher;
use App\Models\ReceivableType;
use App\Models\StockInventory;
use App\Models\TransferParish;
use App\Models\CategoryAccount;
use App\Models\PurchaseInvoice;
use App\Models\SaleTransaction;
use App\Models\TransferProvince;
use App\Models\ProductCategories;
use App\Models\ComplianceProvince;
use App\Models\TempMyTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\DailyCashBookBalance;
use App\Models\WorkingMonthApproval;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyStatementBalance;
use App\Models\CustomerPersonalLedger;
use App\Models\SupplierPersonalLedger;
use App\Models\PaymentVoucherBreakdown;
use App\Models\ProvinceAccountLastDate;
use App\Models\BankStatementOpeningBalance;


function randomDigits()
{
    return Str::random(8);
}
function convertToDate($period)
{
    return Carbon::createFromFormat('M Y', substr($period, 0, 3) . ' ' . substr($period, 3));
}

function audit($action, $modelType, $modelId, $oldValues = [], $newValues = [], $description = null, $agents = null, $auditable = null)
{
    $agent = new Agent();
    // Get device information
    $deviceName = $agent->device();
    // $deviceName = $device['device'];
    // Get operating system information
    $platform = $agent->platform();
    // Get browser information
    $browser = $agent->browser();
    $userAgent = $agent->getUserAgent();
    // dd($userAgent);
    //   $deviceName = Agent::device();
    //   $platform = Agent::platform();
    //   $browser = Agent::browser();
    $userId = Auth::id() ?? 19292;
    // $name = Auth::user()->first_name ?? "" . ' '. Auth::user()->last_name ?? "";
    DB::table('audit_trails')->insert([
        'user_id' => $userId,
        'action' => $action,
        'description' => $description,
        'model_type' => $modelType,
        'url' => url()->current(),
        'machine_name' => $deviceName . ' , ' . $platform . ' , ' . $browser . ' ' . $userAgent,
        'ip_address' => request()->ip(),
        'model_id' => $modelId,
        'auditable_id' => $auditable,
        'old_values' => json_encode($oldValues),
        'new_values' => json_encode($newValues),
        'continent_id' => Auth::user()->continent_id ?? null,
        'province_id' => Auth::user()->province_id ?? null,
        'region_id' => Auth::user()->region_id ?? null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


function formatPhoneNumber($phoneNumber)
{
    $nigeriaPrefixes = [
        '070',
        '080',
        '081',
        '090', // Mobile prefixes
        '0700',
        '0802',
        '0803',
        '0804',
        '0805',
        '0806',
        '0807',
        '0808',
        '0809', // Mobile prefixes
        '0810',
        '0811',
        '0812',
        '0813',
        '0814',
        '0815',
        '0816',
        '0817',
        '0818',
        '0819', // Mobile prefixes
        '0902',
        '0903',
        '0904',
        '0905',
        '0906',
        '0907',
        '0908',
        '0909', // Mobile prefixes
        '07025',
        '07026',
        '07027',
        '07028',
        '07029', // Landline prefixes
        '0802',
        '0803',
        '0804',
        '0805',
        '0806',
        '0807',
        '0808',
        '0809', // Landline prefixes
        '0810',
        '0811',
        '0812',
        '0813',
        '0814',
        '0815',
        '0816',
        '0817',
        '0818',
        '0819', // Landline prefixes
        '0902',
        '0903',
        '0904',
        '0905',
        '0906',
        '0907',
        '0908',
        '0909', // Landline prefixes
        '01',
        '02',
        '03',
        '04',
        '05',
        '06',
        '07',
        '09' // Landline prefixes
    ];

    // Remove any non-digit characters from the phone number
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

    // Check if the phone number starts with a Nigerian prefix
    $startsWithPrefix = false;
    foreach ($nigeriaPrefixes as $prefix) {
        if (substr($phoneNumber, 0, strlen($prefix)) === $prefix) {
            $startsWithPrefix = true;
            break;
        }
    }

    // Format the phone number accordingly
    if (strlen($phoneNumber) === 11 && $startsWithPrefix) {
        // Phone number with the Nigerian prefix
        $formattedNumber = '+234' . substr($phoneNumber, 1);
    } elseif (strlen($phoneNumber) === 10 && !$startsWithPrefix) {
        // Phone number without the Nigerian prefix
        $formattedNumber = '0' . $phoneNumber;
    } else {
        // Invalid phone number
        return [
            'status' => false,
            'message' => 'Invalid phone number',
            'data' => $phoneNumber,
        ];
    }

    return [
        'status' => true,
        'message' => 'Valid phone number',
        'data' => $formattedNumber,
    ];
}

function success_status_code()
{
    return 200;
}

function bad_response_status_code()
{
    return 400;
}
function api_request_response($status, $message, $statusCode, $data = [], $return = false, $returnArray = false)
{
    $responseArray = [
        "status" => $status,
        "message" => $message,
        "data" => $data
    ];

    $response = response()->json(
        $responseArray
    );

    if ($returnArray) {
        return $returnArray;
    }

    if ($return) {
        return $response;
    }

    header('Content-Type: application/json', true, $statusCode);

    echo json_encode($response->getOriginalContent());

    exit();
}

function generate_uuid()
{
    return \Ramsey\Uuid\Uuid::uuid1()->toString();
}


function hasConsecutiveDuplicates($array)
{
    $length = count($array);

    for ($i = 0; $i < $length - 1; $i++) {
        if ($array[$i] === $array[$i + 1]) {
            return true; // Consecutive duplicates found
        }
    }

    return false; // No consecutive duplicates found
}
function convertToUppercase($word)
{
    $words = explode(' ', $word);
    $result = '';
    foreach ($words as $word) {
        $result .= strtoupper(substr($word, 0, 1));
    }
    return $result;
    // return response()->json(['converted_word' => $result]);
}

function respond($status, $message, $data, $code)
{
    return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ], $code);
}



// this is for direction column in journals table
// 1 - direct posting , 2 - remittance, 3 -payments, 4 -receipt/receivable, 5 -lodgement, 6 -customerReceipt, 7 -supplierReceipt, 8 -reversal, 9 - loan, 10 -cashmovement, 11 -cashmovement-reversal, 12 - expenses
//13- uploadreceipt, 14-payable, 15-loanRepaymentExcel,
// function monthEnd($date){
//     $correctDate = Carbon::parse($date);
//     $month = $correctDate->month
// }
