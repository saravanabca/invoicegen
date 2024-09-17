<div class="invoice_preview template-2">
    <h4 class="text-center inv_title_tem2">Invoice</h4>
    <div class="row">
        <div class="col col-md-6">
            <span>Invoice Number</span><br>
            <span class="invoice_number"></span><br>
            <span>Invoice Date</span><br>
            <span>01-02-2024</span><br>
            <span>Due Date</span><br>
            <span>29-02-2024</span>

        </div>
        {{-- <div class="col col-md-6">
            <img src="{{ asset('user/images/invoice/logotest.png') }}" class="compny_logo"
                alt="">
        </div> --}}
    </div>
    <div class="row">
        <div class="col col-md-6">
            <div class="billed-by mt-3">
                <h6>Billed By</h6>
                <span class="CustomerName"></span><br>
                <span>kgtech@gmail.com</span><br>
                <span>18,address line 1</span><br>
                <span>BNZg112334</span><br>
                <span>65878945621</span><br>
            </div>
        </div>
        <div class="col col-md-6">
            <div class="billed-by mt-3">
                <h6>Billed By</h6>
                <span>KG tech</span><br>
                <span>kgtech@gmail.com</span><br>
                <span>18,address line 1</span><br>
                <span>BNZg112334</span><br>
                <span>65878945621</span><br>
            </div>
        </div>
    </div>
    <div class="invoice">
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Rate</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ticket Booking App Ux</td>
                    <td>₹ 6000.00</td>
                    <td>1</td>
                    <td>₹ 6000.00</td>
                </tr>
                <tr>
                    <td>
                        Web Design
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.</p>
                    </td>
                    <td>₹ 7000.00</td>
                    <td>1</td>
                    <td>₹ 7000.00</td>
                </tr>
            </tbody>
        </table>

        <div class="totals">
            <p>Sub Total <span>₹ 13,390.00</span></p>
            <p>GST <span>2 %</span></p>
            <p>Discount <span>₹ 200</span></p>
            <p class="total">Total <span>₹ 13,190.00</span></p>
        </div>

        <div class="notes">
            <h3>Notes / Payment Terms</h3>
            <p>Please pay invoice by 29-07-2023</p>
            <p>Invoice Due time 15 days</p>
        </div>

        <div class="bank-details">
            <h3>Bank Account Details</h3>
            <p>Kg Tech</p>
            <p>Bank of America</p>
            <p>30114913226</p>
            <p>Russell,ky</p>
        </div>

        <div class="signature">
            <p>Signature:</p>
            <img src="signature.png" alt="Signature">
        </div>
    </div>
</div>