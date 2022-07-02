<?php

namespace ItsFaqih\Faspay\Enums;

use MyCLabs\Enum\Enum;

class PaymentChannel extends Enum
{
    private const LINKAJA = '302';
    private const BRI_MOCASH = '400';
    private const BRI_E_PAY = '401';
    private const PERMATA_VIRTUAL_ACCOUNT = '402';
    private const KLIKBCA = '404';
    private const BCA_KLIKPAY = '405';
    private const MAYBANK_VIRTUAL_ACCOUNT = '408';
    private const UNICOUNT = '410';
    private const OCTOCLICKS = '700';
    private const DANAMON_ONLINE_BANKING = '701';
    private const BCA_VIRTUAL_ACCOUNT = '702';
    private const BCA_SAKUKU = '704';
    private const PAYMENT_POINT_INDOMARET = '706';
    private const KREDIVO = '707';
    private const SHOPEEPAY_QRIS = '711';
    private const SHOPEEPAY_APP = '713';
    private const LINKAJA_APP = '716';
    private const BRI_VIRTUAL_ACCOUNT = '800';
    private const BNI_VIRTUAL_ACCOUNT = '801';
    private const MANDIRI_VIRTUAL_ACCOUNT = '802';
    private const AKULAKU = '807';
    private const B_SECURE_PAYMENT_GATEWAY = '812';
    private const OVO = '814';
    private const MAYBANK2U = '818';
    private const SINARMAS_VIRTUAL_ACCOUNT = '819';
    private const DANA = '820';
    private const INDODANA = '825';
    private const CIMB_VIRTUAL_ACCOUNT = '826';
}
