<style type="text/css">
    .wrapper {
        display: grid;
        /*Using the full width/height of the designated box elements, use fr as in example below */
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        /*Delete the two lines above and add more/less columns/rows by specifying one more for each below */
        /* grid-template-columns: 50% 50%; */
        /* grid-template-rows: 50% 50%; */
        /* grid-gap: 0px; */
    }

    .box {
        /* background-color: orange; */
        /*Play with all the columns/rows width/height properties to get what you're desiring*/
        margin: 0px;

        height: auto;
        min-height: 33%;
        max-height: 33%;

        width: auto;
        min-width: 90%;
        max-width: 90%;
        overflow: hidden;
    }

    */ body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .logo img {
        width: 150px;
        height: auto;
    }

    .mini-logo {
        margin: 0px;

        height: auto;
        min-height: 50px;
        max-height: 50px;

        width: auto;
        min-width: 50px;
        max-width: 50px;
    }

    .mini-logo img {
        height: auto;
        min-height: 50px;
        max-height: 50px;

        width: auto;
        min-width: 50px;
        max-width: 50px;

        margin: 0px auto 0px;
    }

    .document-logo {
        margin: 0px;

        height: auto;
        min-height: 50px;
        max-height: 50px;

        width: auto;
        min-width: auto;
        max-width: 100%;
        position: relative;

        align-content: center;
    }

    .document-logo img {
        position: absolute;
        top: 0%;
        right: 40%;
        height: auto;
        min-height: 50px;
        max-height: 50px;

        width: auto;
        min-width: auto;
        max-width: auto;

        margin: 0px auto 0px;
    }

    .letterhead {
        position: relative;
        width: 100%;
        z-index: -10;
    }

    .letterhead img {
        width: 100%;
    }

    .letterhead .top {}

    .letterhead .bottom {
        position: absolute;
        margin-top: 25px;
        bottom: 1%;
        left: 0%;
    }

    .stamp img {
        z-index: 999;
        left: 75%;
        bottom: 2%;
        position: absolute;

        width: 200px;
        height: auto;
    }

    .border-less * {
        border: none;
    }

    .minified {
        height: auto;
        min-height: 7px;
        max-height: 7px;
        line-height: 7px;
        font-size: 14px;
    }

    .minified-xs {
        height: auto;
        min-height: 4.5px;
        max-height: 4.5px;
        line-height: 4.5px;
        font-size: 9px;
    }

    .ml-5 {
        margin-left: 5%;
    }

    .ml-10 {
        margin-left: 10%;
    }

    .ml-15 {
        margin-left: 15%;
    }

    .ml-20 {
        margin-left: 20%;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .p-10 {
        padding: 0px 10px 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .mt-25 {
        margin-top: 25px;
    }

    .mt-50 {
        margin-top: 50px;
    }

    .mt-75 {
        margin-top: 75px;
    }

    .mt-100 {
        margin-top: 100px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-90 {
        width: 90%;
    }

    .w-80 {
        width: 80%;
    }

    .w-85 {
        width: 85%;
    }

    .w-50 {
        width: 50%;
    }


    .w-15 {
        width: 15%;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }

    .page-break {
        page-break-after: always;
    }
</style>
