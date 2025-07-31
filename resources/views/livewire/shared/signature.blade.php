<div class="signature-box clearfix">
    <h2 class="signature-heading">
        KIDUMU CHAMA CHA MAPINDUZI
    </h2>
    <div class="signature">
        <img src="{{ $signature }}" alt="signature">
    </div>
    <p class="title">
        CPA. Amos Gabriel Makalla
    </p>
    <h2 class="signature-heading">
        KATIBU WA HALMASHAURI KUU YA CCM TAIFA,ITIKADI, UENEZI NA MAFUNZO
    </h2>
    <p class="caption">
        {{ \Carbon\Carbon::parse($letter->published_at)->format('d/m/Y') }}
    </p>
    <div class="qr-code">
        <img src="{{ $qr_code }}" alt="QR Code">
    </div>
</div>
