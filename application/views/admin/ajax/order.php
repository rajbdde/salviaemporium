<table id="example_" class="table table-bordered table-head-fixed text-nowrap">
    <thead>
        <tr>
            <th>OR ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>P-Type</th>
            <th>P-Status</th>
            <th>Status</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($orders) <= 0):?>
        <tr><td colspan="8"><h3 class="text-danger font-weight-bold text-center">No order available!</h3></td></tr>
        <?php endif;?>
        <?php foreach ($orders as $product): ?>
            <tr>
                <td class="<?= strtolower($product->status); ?>">SEORD<?= $product->id; ?></td>
                <td><?= $product->order_name . '-' . $product->time; ?></td>
                <td><?= $product->total_amount; ?></td>
                <td><?= $product->payment_type; ?></td>
                <td>
                    <select class="paystatus" for="<?= $product->id; ?>">
                        <option value="0" <?= $product->payment_status == 0 ? 'selected' : ''; ?>>Unpaid </option>
                        <option value="1" <?= $product->payment_status == 1 ? 'selected' : ''; ?>>Paid</option>
                    </select>&nbsp;&nbsp;
                    <?= ($product->payment_status == 1) ? '<i class="fas fa-check-square text-success fasize"></i>' : '<i class="fa fa-window-close text-danger fasize"></i>'; ?>
                </td>
                <td>
                    <select class="orderstatus" for="<?= $product->id; ?>">
                        <option value="pending" <?= $product->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="processing" <?= $product->status == 'processing' ? 'selected' : ''; ?>>Processing</option>
                        <option value="shipped" <?= $product->status == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                        <option value="delivered" <?= $product->status == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                        <option value="cancel" <?= $product->status == 'cancel' ? 'selected' : ''; ?>>Cancel</option>
                    </select>&nbsp;&nbsp;
                    <?= ($product->status == 'pending') ? '<i class="fa fa-window-close fasize text-danger"></i>' : '<i class="fas fa-check-square fasize '.$product->status.'"></i>'; ?>
                </td>
                <!--<td><?#= timespan($product->time, now(), 1); ?> ago</td>-->
                <td><?= mdate('%d-%m-%Y  %h:%i %a', $product->time); ?></td>
                <td>
                    <button type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#ordermodal" onclick="getorderbymod(<?= $product->id; ?>)"><i class="fa fa-eye"></i></button>
                    <a href="<?= base_url('order/invoices/' . $product->id); ?>.html"><button class="btn-sm btn-primary"><i class="fas fa-file-invoice-dollar"></i></button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>