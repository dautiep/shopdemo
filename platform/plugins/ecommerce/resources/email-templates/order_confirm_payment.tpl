{{ header }}

<h2>Payment for order #{{ order_id }} was confirmed!</h2>
<p>Xin chào, {{ customer_name }},</p>
<p>Cảm ơn bạn đã đặt hàng của chúng tôi</p>
<br />

<h3>Thông tin đơn hàng: </h3>

<p>Mã đơn hàng: <strong>#{{ order_id }}</strong></p>

{{ product_list }}

<h3>Địa chỉ khách hàng</h3>

<p>{{ customer_name }} - {{ customer_phone }}, {{ customer_address }}</p>

<br />
{{ footer }}
