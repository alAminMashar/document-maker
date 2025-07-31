<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
    }

    body * {
        padding: 0px;
        margin: 0px;
    }

    /** Set spacing to avoid overlapping the content */
    body {
        width: auto;
        min-width: 100%;
        max-width: 100%;
        margin-top: 165px;
        /* adjust based on header height */
        margin-bottom: 100px;
        /* adjust based on footer height */
    }

    .page-break {
        page-break-after: always;
    }


    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .signature-box {
        position: relative;
        margin: 20px auto;
        width: auto;
        min-width: 74%;
        max-width: 74%;
        height: auto;
        min-height: 250px;
        max-height: 250px;
        overflow: visible;
        /* border: dashed 1px red; */
    }


    .signature-box * {
        color: #000000;
        text-align: center;
    }

    .signature-box .signature-heading {
        color: #000000;
        font-size: 25px;
        line-height: 25px;
        text-align: center;
        font-weight: bold;
        /* margin: 1% auto 1%; */
    }

    .signature-box .title,
    .signature-box .caption {
        color: #000000;
        font-size: 24px;
        line-height: 24px;
        text-align: center;
        font-weight: normal;
        /* margin: 1% auto 1%; */
    }

    .signature-box .signature {
        position: relative;
        width: auto;
        min-width: 100%;
        max-width: 100%;
        height: auto;
        min-height: 95px;
        max-height: 95px;
        /* border: dashed 1px blue; */
    }

    .signature-box .signature img {
        position: absolute;
        top: -15px;
        left: 24%;
        width: auto;
        min-width: auto;
        max-width: auto;
        height: auto;
        min-height: 140px;
        max-height: 140px;
        /* border: dashed 1px pink; */
    }

    .signature-box .qr-code {
        position: absolute;
        top: 120px;
        right: -100px;
        width: 100px;
        height: 100px;
        z-index: 100;
    }

    .signature-box .qr-code img {
        width: auto;
        min-width: auto;
        max-width: 100px;
        height: 100px;
        min-height: 100px;
        max-height: 100px;
    }
</style>
