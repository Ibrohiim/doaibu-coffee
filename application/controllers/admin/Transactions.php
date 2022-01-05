<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Transactions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Products_model', 'products');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Table_model', 'table');
        if ($this->admin->is_role() != 1 && $this->admin->is_role() != 4) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Scan Transaction';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = array(
            'title' => $title,
            'user' => $user,
        );

        $this->template->load('templates/admin/templates', 'admin/transactions/scan-qrcode', $data);
    }
    public function scanningProcess()
    {
        $code               = $this->input->post('code');
        $cek_code           = $this->transaction->cek_code($code);
        $cek_invoice        = $this->transaction->cek_invoice($code);
        if ($cek_invoice && $cek_invoice->payment_status == 'Complete') {
            $code               = $cek_invoice->transaction_code;
            $tablecode          = $cek_invoice->table_number;
            $table              = $this->table->getTableCode($tablecode);
            $customer_name      = $cek_invoice->customer_name;
            $order_type         = $cek_invoice->order_type;
            $transaction_date  = $cek_invoice->transaction_date;
            $total_transaction  = $cek_invoice->total_transaction;
            $payment_status     = $cek_invoice->payment_status;
            $data = array(
                'transaction_code'  => $code,
                'table_number'      => $table->table_name,
                'customer_name'     => $customer_name,
                'order_type'        => $order_type,
                'transaction_date' => $transaction_date,
                'total_transaction' => $total_transaction,
                'payment_status'    => $payment_status,
            );
            $this->session->set_flashdata('message', '<div class="alert alert-warning text-center" role="alert" style="margin-bottom: 0;"><strong>Already made a transaction!</strong></div>');
            $this->load->view('admin/transactions/scan-result', $data);
        } else if (!$cek_code) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert" style="margin-bottom: 0;"><strong>Data not found!</strong></div>');
            $this->load->view('admin/transactions/scan-result');
        } else {
            $code               = $cek_code->transaction_code;
            $tablecode          = $cek_code->table_number;
            $table              = $this->table->getTableCode($tablecode);
            $customer_name      = $cek_code->customer_name;
            $order_type         = $cek_code->order_type;
            $transaction_date  = $cek_code->transaction_date;
            $total_transaction  = $cek_code->total_transaction;
            $payment_status     = $cek_code->payment_status;

            $data = array(
                'transaction_code'  => $code,
                'table_number'      => $table->table_name,
                'customer_name'     => $customer_name,
                'order_type'        => $order_type,
                'transaction_date' => $transaction_date,
                'total_transaction' => $total_transaction,
                'payment_status'    => $payment_status,
            );
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert" style="margin-bottom: 0;"><strong>Transaction with code ' . $code . ' has been found!</strong></div>');
            $this->load->view('admin/transactions/scan-result', $data);
        }
    }
    public function sales()
    {
        $transaction_code = date('dmY') . strtoupper(random_string('alnum', 10));
        redirect(base_url('admin/transactions/salestransactions/' . $transaction_code));
    }
    public function salesTransactions($code = '')
    {
        $title  = 'Sales Transactions';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $invoice     = $this->transaction->getInvoice($code);
        $transaction = $this->transaction->getCart($code);
        $categories  = $this->transaction->get_categories();
        $items       = $this->cart->contents();
        $table  = $this->admin->getTable();
        $transaction_code = $this->uri->segment(4);
        $site        = $this->configuration_model->getConfig();
        if ($invoice) {
            $data = array(
                'title' => $title,
                'user'  => $user,
                'table' => $table,
                'items' => $items,
                'site' => $site,
                'invoice'     => $invoice[0],
                'transaction' => $transaction,
                'categories'  => $categories,
                'transaction_code' => $transaction_code,
            );
            $this->template->load('templates/admin/templates', 'admin/transactions/sales-transactions', $data);
        } else {
            redirect(base_url('admin/transactions'));
        }
    }
    public function cancelTransaction()
    {
        $cart = $this->cart->contents();
        if ($cart == true) {
            $this->cart->destroy();
        }
        redirect(base_url('admin/transactions/sales/'));
    }
    public function checkcategory($category_id)
    {
        $products = $this->products->get_by_category($category_id);
        echo json_encode($products);
    }
    public function checkproduct($product_id)
    {
        $products = $this->products->get_by_product($product_id);
        echo json_encode($products);
    }
    public function add_menu()
    {
        $product_id = $this->input->post('product_id');
        $quantity   = $this->input->post('quantity');
        $sale_price = $this->input->post('sale_price');
        $code       = $this->input->post('transaction_code');
        $date       = $this->input->post('transaction_date');
        $bt         = $this->input->post('bursttime');
        $cek_id     = $this->transaction->cekId($code, $product_id);
        $cek_qty    = $cek_id->quantity;
        $id_transaction = $cek_id->id_transaction;

        $sub_total = $quantity * $sale_price;
        $bursttime = $quantity * $bt;
        $data = array(
            'transaction_code'  => $code,
            'id_product'        => $product_id,
            'price'             => $sale_price,
            'quantity'          => $quantity,
            'total_price'       => $sub_total,
            'bursttime_product' => $bursttime,
            'transaction_date'  => $date,
        );
        if ($cek_id == !null) {
            $total_qty = $cek_qty + $quantity;
            $where = array('id_transaction' => $id_transaction);
            $newdata = [
                'quantity' => $total_qty,
            ];
            $this->transaction->update($where, $newdata, 'transaction');
            echo json_encode(array('status' => 'success'));
        } else {
            $this->db->insert('transaction', $data);
            echo json_encode(array('status' => 'success'));
        }
    }
    public function deletemenu()
    {
        $id = $this->input->post('id');

        $where = array('id_transaction' => $id);

        $this->transaction->delete($where, 'transaction');

        echo json_encode(array('status' => 'success'));
    }
    public function addtocart()
    {
        $id             = $this->input->post('id');
        $qty            = $this->input->post('qty');
        $price          = $this->input->post('price');
        $bursttime      = $this->input->post('bursttime');

        $product    = $this->products->detail_by_id($id);
        if ($product) {
            $data = array(
                'id'      => $id,
                'qty'     => $qty,
                'price'   => $price,
                'name'    => $product[0]['product_name'],
                'bursttime' => $bursttime,
            );
            $this->cart->insert($data);
            echo json_encode(
                array(
                    'status' => 'success',
                    'data' => $this->cart->contents(),
                    'total_item' => $this->cart->total_items(),
                    'total_price' => $this->cart->total()
                )
            );
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function deleteitem($rowid)
    {
        if ($this->cart->remove($rowid)) {
            echo number_format($this->cart->total());
        } else {
            echo "false";
        }
    }
    public function updateitem($rowid)
    {
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');

        $data = array(
            'rowid' => $rowid,
            'qty' => $qty,
        );
        $this->cart->update($data);

        echo json_encode(array('status' => 'success'));
    }
    public function transactionprocess()
    {
        $transaction_code = $this->input->post('transaction_code');
        $grand_total    = $this->input->post('grand_total');
        $cashier        = $this->input->post('cashier');
        $order_type     = $this->input->post('order_type');
        $table_number   = $this->input->post('table_number');
        $customer_name  = $this->input->post('customer_name');
        $total_bursttime  = $this->input->post('total_bursttime');
        $cek_invoice    = $this->transaction->cek_invoice($transaction_code);

        if ($cek_invoice && $cek_invoice->transaction_code == $transaction_code) {
            $where = array('transaction_code' => $transaction_code);
            $data = [
                'total_transaction' => $grand_total,
                'total_bursttime'   => $total_bursttime,
                'payment_status'    => 'Complete',
                'transaction_date'  => date('Y-m-d H:i:s'),
                'cashier'           => $cashier,
            ];
            $this->transaction->update($where, $data, 'invoice');
            $datatrans = [
                'transaction_date'  => date('Y-m-d H:i:s'),
            ];
            $this->transaction->update($where, $datatrans, 'transaction');
            echo $this->struckTransaction();
        } else {
            $newdata = array(
                'cashier'           => $cashier,
                'table_number'      => $table_number,
                'order_type'        => $order_type,
                'customer_name'     => $customer_name,
                'transaction_code'  => $transaction_code,
                'transaction_date'  => date('Y-m-d H:i:s'),
                'total_transaction' => $grand_total,
                'total_bursttime'   => $total_bursttime,
                'payment_status'    => 'Complete',
                'order_status'      => 'Waiting',
            );
            $this->db->insert('invoice', $newdata);

            foreach ($this->cart->contents() as $item) {
                $sub_total = $item['qty'] * $item['price'];
                $bursttime = $item['qty'] * $item['bursttime'];
                $datacart = array(
                    'transaction_code'  => $transaction_code,
                    'id_product'        => $item['id'],
                    'price'             => $item['price'],
                    'quantity'          => $item['qty'],
                    'bursttime_product' => $bursttime,
                    'total_price'       => $sub_total,
                    'transaction_date'  => date('Y-m-d H:i:s'),
                    'status_queue'      => 'Waiting',
                );
                $this->db->insert('transaction', $datacart);
            }

            $table = array(
                'status' => 'active',
            );
            $where = array('table_code' => $table_number);
            $this->admin->update($where, $table, 'customer_table');

            $this->cart->destroy();

            echo $this->struckTransaction();
        }
    }
    public function struckTransaction()
    {
        $code = $this->input->post('transaction_code');
        $site        = $this->configuration_model->getConfig();
        $invoice     = $this->transaction->getInvoice($code);
        $transaction = $this->transaction->getCart($code);
        $cash        = $this->input->post('cash');
        $change      = $this->input->post('change');
        $data = [
            'site'      => $site,
            'invoice'   => $invoice[0],
            'transaction' => $transaction,
            'cash'      => $cash,
            'change'    => $change,
        ];
        $this->load->view('admin/transactions/struck-transaction', $data);
    }
    public function listTransactions()
    {
        $title  = 'List Transactions';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $transaction = $this->transaction->dataInvoice();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'transaction' => $transaction,
        );

        $this->template->load('templates/admin/templates', 'admin/transactions/list-transactions', $data);
    }
    public function detailTransaction($code)
    {
        $title      = 'List Transactions';
        $subtitle   = 'Detail Transactions';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $invoice    = $this->transaction->getInvoice($code);
        $transactions = $this->transaction->getTransaction($code);

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'invoice'   => $invoice[0],
            'transactions' => $transactions,
        );

        $this->template->load('templates/admin/templates', 'admin/transactions/detail-transactions', $data);
    }
    public function deletetransaction($code)
    {
        $where = array('transaction_code' => $code);
        $this->admin->delete($where, 'transaction');
        $this->admin->delete($where, 'invoice');
        $this->session->set_flashdata('message', 'Transaction Successfully Delete!');
        redirect(base_url('admin/transactions/listtransactions'), 'refresh');
    }
}
