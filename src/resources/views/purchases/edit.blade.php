<p>送付先住所変更画面</p>


{{-- 配送先 --}}
<div class="form__group">
    <h3 class="form__group-title">配送先</h3>
    <div class="form__group-content">
        <div class="purchase__shipping-address">
            <p>〒{{ auth()->user()->postal_code ?? '' }}</p>
            <p>{{ auth()->user()->address ?? '' }}</p>
        </div>

        <p>配送先：{{ auth()->user()->address ?? '未登録' }}</p>
    </div>
</div>
