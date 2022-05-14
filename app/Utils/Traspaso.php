<?php
/**
 * Created by PhpStorm.
 * User: devnello
 * Date: 11/02/2019
 * Time: 20:38
 */

namespace App\Utils;


use Illuminate\Support\Facades\DB;

class Traspaso
{

    private $user;

    public function __construct()
    {
        $this->user = 'MSP';
    }

    public function getFlagAct(int $val)
    {
        if ($val == 1) {
            return 'I';
        } else {
            return 'A';
        }
    }

    public function getFlagHabitual(int $val)
    {
        if ($val == 1) {
            return 'S';
        } else {
            return 'N';
        }
    }


    public function getUnidadesMesura(int $val)
    {
        if ($val == 1) {
            return 'mt';
        } else if ($val == 2) {
            return 'cm';
        } else if ($val == 3) {
            return 'mm';
        } else if ($val == 4) {
            return 'h';
        } else
            return 'ud';

        //        0, , 0
        //1, mts., 0
        //2, cm., 0
        //3, mm., 0
        //4, h., 0

    }


    // Insert Familas
    public function insertFamilias()
    {


        $familias_old = DB::table('gpc.families')->get();

        $codigo = 0;
        foreach ($familias_old as $f_old) {

            // $f_old['CodiFamMat'];
            // $f_old['Nom'];
            // $f_old['Antic'];

            $f = [];

            $f['codigo'] = $codigo++; // Eliminar el Codigo
            $f['nombre'] = $f_old->Nom;
            $f['descuento'] = 0;
            // $f['created_at'] = '';
            // $f['updated_at'] = '';
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;

            $f['flgact'] = $this->getFlagAct($f_old->Antic);

            $f['codifammat'] = $f_old->CodiFamMat;


            // DB::table('gpc_des.gpc_familias')->insert($f);
            Helper::insTabla('gpc_des.gpc_familias', $f);

        }
    }

    // Insert Fabricantes
    public function insertFabricantes()
    {

        $fabricantes_old = DB::table('gpc.fabricants')->get();

        $codigo = 0;
        foreach ($fabricantes_old as $f_old) {

            // $f_old['CodiFamMat'];
            // $f_old['Nom'];
            // $f_old['Antic'];

            $f = [];

            $f['codigo'] = $codigo++; // Eliminar el Codigo
            $f['nombre'] = $f_old->Nom;
            $f['descuento'] = 0;
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;

            $f['flgact'] = $this->getFlagAct($f_old->Antic);

            $f['codifabmat'] = $f_old->CodiFabMat;


            // DB::table('gpc_des.gpc_familias')->insert($f);
            Helper::insTabla('gpc_des.gpc_fabricantes', $f);

        }
    }

    // Insert Materiales
    public function insertMateriales()
    {
        // todo: añadir mm,cm,h a unidades mesura de materiales

        // Duración 8 minutos
        // $fs_old = DB::table('gpc.materials')->take(10)->get();
        $fs_old = DB::table('gpc.materials')->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];

            $f['codigo'] = $codigo++;
            $f['descripcion'] = $f_old->Descripcio;
            $f['ref_fabricante'] = $f_old->ReferenciaF;
            $f['unidades'] = $this->getUnidadesMesura($f_old->CodiUM);
            $familia_id = DB::table(Tab::GPC_FAMILIAS)->where('codifammat', $f_old->CodiFamMat)->first();
            $fabricante_id = DB::table(Tab::GPC_FABRICANTES)->where('codifabmat', $f_old->CodiFabMat)->first();
            $f['fabricante_id'] = $fabricante_id->id;
            $f['familia_id'] = $familia_id->id;
            $f['categoria'] = null;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);
            $f['codimaterial'] = $f_old->CodiMaterial;
            $f['codifammat'] = $f_old->CodiFamMat;
            $f['codifabmat'] = $f_old->CodiFabMat;

            Helper::insTabla('gpc_des.gpc_materiales', $f);

        }
    }


    // Insert Proveedores
    public function insertProveedores()
    {
        // $fs_old = DB::table('gpc.proveidors')->take(10)->get();

        $fs_old = DB::table('gpc.proveidors')->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];

            // $familia_id = DB::table(Tab::GPC_FAMILIAS)->where('codifammat', $f_old->CodiFamMat)->first();
            // $fabricante_id = DB::table(Tab::GPC_FABRICANTES)->where('codifabmat', $f_old->CodiFabMat)->first();


//            $f['CodiProveidor'] = $f_old;
//            $f['Nom'] = null;
//            $f['Email'] = null;
//            $f['WWW'] = null;
//            $f['CIF'] = null;
//            $f['Telefon1'] = null;
//            $f['Telefon2'] = null;
//            $f['FAX'] = null;
//            $f['Antic'] = null;
//            $f['DiaPagament'] = null;
//            $f['PagaA'] = null;
//            $f['NumClient'] = null;
//            $f['CodiFP'] = null;
//            $f['CodiFE'] = null;
//            $f['Idioma'] = XX;


            //
            $f['codigo'] = $f_old->CodiProveidor;
            $f['nombre'] = $f_old->Nom;
            $f['cif'] = $f_old->CIF;
            $f['email'] = $f_old->Email;
            $f['sito_web'] = $f_old->WWW;
            $f['telefono_1'] = $f_old->Telefon1;
            $f['telefono_2'] = $f_old->Telefon2;
            $f['fax'] = $f_old->FAX;
            $f['paga_a'] = $f_old->PagaA;
            $f['dia_pagamento'] = $f_old->DiaPagament;
            $f['forma_pago_id'] = null;
            $f['forma_envio'] = null;
            $f['idioma_id'] = null;
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);
            $f['codiproveidor'] = $f_old->CodiProveidor;

            Helper::insTabla(Tab::GPC_PROVEEDORES, $f);

        }
    }

    public function insertProveedoresDirecciones()
    {
        $fs_old = DB::table('gpc.proveidors_adreçes')->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];

//            $f_old['CodiAdProveidor'] = XX;
//            $f_old['Nom'] = null;
//            $f_old['Part1'] = null;
//            $f_old['Part2'] = null;
//            $f_old['Poblacio'] = null;
//            $f_old['Provincia'] = null;
//            $f_old['CP'] = null;
//            $f_old['CodiProveidor'] = XX;
//            $f_old['Antic'] = null;

            $f['nombre'] = $f_old->Nom;
            $f['part1'] = $f_old->Part1;
            $f['part2'] = $f_old->Part2;
            $f['poblacion'] = $f_old->Poblacio;
            $f['provincia'] = $f_old->Provincia;
            $f['cp'] = $f_old->CP;
            $f['flghab'] = 'N';
            $proveedor = DB::table(Tab::GPC_PROVEEDORES)->where('codiproveidor', $f_old->CodiProveidor)->first();
            $f['proveedor_id'] = $proveedor->id;
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);
            $f['codiadproveidor'] = $f_old->CodiAdProveidor;
            $f['codiproveidor'] = $f_old->CodiProveidor;


            Helper::insTabla(Tab::GPC_PROVEEDORES_DIRECCIONES, $f);

        }
    }

    public function insertProveedoresContactos()
    {
        $fs_old = DB::table('gpc.proveidors_contactes')->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];

//            $f_old->CodiConProveidor
//            $f_old->Nom
//            $f_old->Email
//            $f_old->Telefon
//            $f_old->Mobil
//            $f_old->FAX
//            $f_old->CodiProveidor
//            $f_old->Antic
//            $f_old->Habitual


            $f['nombre'] = $f_old->Nom;
            $f['email'] = $f_old->Email;
            $f['telefono'] = $f_old->Telefon;
            $f['mobil'] = $f_old->Mobil;
            $f['fax'] = $f_old->FAX;
            $f['flghab'] = $this->getFlagHabitual($f_old->Habitual);
            $proveedor = DB::table(Tab::GPC_PROVEEDORES)->where('codiproveidor', $f_old->CodiProveidor)->first();
            $f['proveedor_id'] = $proveedor->id;
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);
            $f['codiconproveidor'] = $f_old->CodiConProveidor;
            $f['codiproveidor'] = $f_old->CodiProveidor;

            Helper::insTabla(Tab::GPC_PROVEEDORES_CONTACTOS, $f);

        }
    }

    public function insertTrasportista()
    {
        $fs_old = DB::table('gpc.transportistes')->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];

            //            $f_old->Codi
            //            $f_old->Nom
            //            $f_old->Telefon
            //            $f_old->Antic


            $f['nombre'] = $f_old->Nom;
            $f['telefono'] = $f_old->Telefon;
            $f['flghab'] = 'S';
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);
            $f['codi'] = $f_old->Codi;


            Helper::insTabla(Tab::GPC_TRANSPORTISTAS, $f);

        }
    }

    public function insertProveedoresTrasportista()
    {
        $fs_old = DB::table('gpc.proveidors_transportistes')->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];


//            $f_old->CodiProv
//            $f_old->CodiTran


//            $f['nombre'] = $f_old->Nom;
//            $f['telefono'] = $f_old->Telefon;
//            $f['flghab'] = 'S';
//            $f['created_user'] =  $this->user;
//            $f['updated_user'] =  $this->user;
//            $f['flgact'] = $this->getFlagAct($f_old->Antic);
//            $f['codi'] = $f_old->Codi;


            $proveedor = DB::table(Tab::GPC_PROVEEDORES)->where('codiproveidor', $f_old->CodiProv)->first();
            $f['proveedor_id'] = $proveedor->id;

            $transportista = DB::table(Tab::GPC_TRANSPORTISTAS)->where('codi', $f_old->CodiTran)->first();
            $f['transportista_id'] = $transportista->id;

            $f['flghab'] = 'S';
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = 'A';
            $f['codiprov'] = $f_old->CodiProv;
            $f['coditran'] = $f_old->CodiTran;


            Helper::insTabla(Tab::GPC_PROVEEDORES_TRANSPORTISTAS, $f);

        }
    }

    public function insertMaterialesProveedores()
    {
        $fs_old = DB::table('gpc.materials_proveidors')->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];

//            $f_old->CodiMaterial
//            $f_old->CodiProveidor
//            $f_old->PreuC
//            $f_old->Dte
//            $f_old->PreuCNet
//            $f_old->Marge
//            $f_old->PreuVNet
//            $f_old->Habitual
//            $f_old->UnitatF

            $material = DB::table(Tab::GPC_MATERIALES)->where('codimaterial', $f_old->CodiMaterial)->first();
            $f['material_id'] = $material->id;

            $proveedor = DB::table(Tab::GPC_PROVEEDORES)->where('codiproveidor', $f_old->CodiProveidor)->first();
            $f['proveedor_id'] = $proveedor->id;

            $f['precio_coste'] = $f_old->PreuC;
            $f['descuento'] = $f_old->Dte;
            $f['precio_coste_neto'] = $f_old->PreuCNet;
            $f['margen'] = $f_old->Marge;
            $f['precio_venta_neto'] = $f_old->PreuVNet;
            $f['unidades_fabricante'] = $f_old->UnitatF;
            $f['flghab'] = $this->getFlagHabitual($f_old->Habitual);
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = 'A';
            $f['codimaterial'] = $f_old->CodiMaterial;
            $f['codiproveidor'] = $f_old->CodiProveidor;


            Helper::insTabla(Tab::GPC_MATERIALES_PROVEEDORES, $f);

        }
    }

    // Insert Clientes
    public function insertClientes()
    {
        // $fs_old = DB::table('gpc.proveidors')->take(10)->get();

        $fs_old = DB::table('gpc.clients')->where('CodiClient','<>',9911)->get();

        $codigo = 0;
        foreach ($fs_old as $f_old) {

            $f = [];

            // $familia_id = DB::table(Tab::GPC_FAMILIAS)->where('codifammat', $f_old->CodiFamMat)->first();
            // $fabricante_id = DB::table(Tab::GPC_FABRICANTES)->where('codifabmat', $f_old->CodiFabMat)->first();

//            $f_old->CodiClient;
//            $f_old->Nom;
//            $f_old->Email;
//            $f_old->WWW;
//            $f_old->CIF;
//            $f_old->Telefon1;
//            $f_old->Telefon2;
//            $f_old->FAX;
//            $f_old->Antic;
//            $f_old->DiaPagament;
//            $f_old->PagaA;
//            $f_old->NomBanc;
//            $f_old->Compte;
//            $f_old->NumProveidor;
//            $f_old->CodiBanc1;
//            $f_old->CodiBanc2;
//            $f_old->CodiBanc3;
//            $f_old->CodiFP;
//            $f_old->Km;
//            $f_old->CodiSector;
//            $f_old->Idioma;

            // IBAN = ES69-2038-6662-2230-0026-3024  varchar(24)

//            Código del país
//ISO 3166	Digito de control IBAN	BBAN (Código Básico de Cuenta Bancaria)
//Código de la Caixa	Sucursal de la cuenta	Digito de control Banco	Número de cuenta
//ES	98	2038	5778	98	30-0076-0236

            $f['codigo'] = $f_old->CodiClient;
            $f['nombre'] = $f_old->Nom;
            $f['email'] = $f_old->Email;
            $f['sito_web'] = $f_old->WWW;
            $f['cif'] = $f_old->CIF;
            $f['telefono_1'] = $f_old->Telefon1;
            $f['telefono_2'] = $f_old->Telefon2;
            $f['fax'] = $f_old->FAX;


            if (trim($f_old->NomBanc) != null) {

                $bancoTemp = DB::table('gpc_des.gpc_bancos_temp')->where('NomBanc', $f_old->NomBanc)->first();

                if ($bancoTemp == null) {
                    $bancoTemp = $bancoTemp;
                }

                $banco = DB::table(Tab::GPC_BANCOS)->where('nombre', $bancoTemp->Banco)->first();
                // $f['material_id'] = $bancoTemp->Banco;

                if ($banco == null) {
                    $banco = $banco;
                }

                $f['banco_id'] = $banco->id;
            }

            // $f['codigo_caja_1'] = $f_old->CodiBanc1; //4
            // $f['codigo_sucursal_2'] = $f_old->CodiBanc2; //4
            // $f['codigo_control_3'] = $f_old->CodiBanc3; //2
            // $f['numero_cuenta'] = $f_old->Compte; //10

            $f['iban'] = 'ESXX';

            if ($f_old->CodiBanc1 != null) {
                $f['iban'] = $f['iban'] . $f_old->CodiBanc1;
            } else {
                $f['iban'] = $f['iban'] . 'XXXX';
            }

            if ($f_old->CodiBanc2 != null) {
                $f['iban'] = $f['iban'] . $f_old->CodiBanc2;
            } else {
                $f['iban'] = $f['iban'] . 'ZZZZ';
            }

            if ($f_old->CodiBanc3 != null) {
                $f['iban'] = $f['iban'] . $f_old->CodiBanc3;
            } else {
                $f['iban'] = $f['iban'] . 'DD';
            }

            if ($f_old->Compte != null) {
                $f['iban'] = $f['iban'] . $f_old->Compte;
            } else {
                $f['iban'] = $f['iban'] . 'CCCCCCCCCC';
                $f['iban'] = null;
            }

            $f['dia_pagamento'] = $f_old->DiaPagament;
            $f['paga_a_dias'] = $f_old->PagaA;
            $f['distancia_km'] = $f_old->Km;

            $f['forma_pago_id'] = null;
            $f['sector_id'] = null;
            $f['idioma_id'] = null;

            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);
            $f['codiclient'] = $f_old->CodiClient;
            $f['numproveidor'] = $f_old->NumProveidor;


            Helper::insTabla(Tab::GPC_CLIENTES, $f);

        }
    }


    public function insertDireccionCliente()
    {
        $fs_old = DB::table('gpc.clients_adreçes')->where('codiclient','<>',9911)->get();

        foreach ($fs_old as $f_old) {

            $f = [];


//            $f_old->CodiAdClient;
//            $f_old->Nom;
//            $f_old->Part1;
//            $f_old->Part2;
//            $f_old->Poblacio;
//            $f_old->Provincia;
//            $f_old->CP;
//            $f_old->CodiClient;
//            $f_old->AdOfertes;
//            $f_old->AdComandes;
//            $f_old->AdAlbarans;
//            $f_old->AdFactures;
//            $f_old->Antic;
//            $f_old->Departament;


            $cliente = DB::table(Tab::GPC_CLIENTES)->where('codiclient', $f_old->CodiClient)->first();

            if ($cliente == null) {
                $cliente = $cliente;
            }


            $f['cliente_id'] = $cliente->id;
            $f['nombre'] = $f_old->Nom;
            $f['part_1'] = $f_old->Part1;
            $f['part_2'] = $f_old->Part2;
            $f['poblacion'] = $f_old->Poblacio;
            $f['provincia'] = $f_old->Provincia;
            $f['codigo_postal'] = $f_old->CP;

            $f['flgadroferta'] = $this->getFlagHabitual($f_old->AdOfertes);
            $f['flgadrpedido'] = $this->getFlagHabitual($f_old->AdComandes);
            $f['flgadralbaran'] = $this->getFlagHabitual($f_old->AdAlbarans);
            $f['flgadrfactura'] = $this->getFlagHabitual($f_old->AdFactures);

            $f['departamento'] = null;
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);
            $f['codiclient'] = $f_old->CodiClient;


            Helper::insTabla(Tab::GPC_DIRECCIONES_CLIENTE, $f);

        }
    }

    public function insertContactosCliente()
    {
        $fs_old = DB::table('gpc.clients_contactes')->where('codiclient','<>',9911)->get();

        foreach ($fs_old as $f_old) {

            $f = [];

            $f_old->CodiConClient;
            $f_old->Nom;
            $f_old->Email;
            $f_old->Telefon;
            $f_old->Mobil;
            $f_old->FAX;
            $f_old->CodiClient;
            $f_old->Antic;
            $f_old->Habitual;

            $cliente = DB::table(Tab::GPC_CLIENTES)->where('codiclient', $f_old->CodiClient)->first();


            $f['cliente_id'] = $cliente->id;
            $f['nombre'] = $f_old->Nom;
            $f['email'] = $f_old->Email;
            $f['telefono'] =  $f_old->Telefon;
            $f['mobil'] = $f_old->Mobil;
            $f['fax'] = $f_old->FAX;
            $f['flghab'] = $this->getFlagHabitual($f_old->Habitual);
            // $f['contacto_dirigido'] = XX;
            $f['flgres'] = 'N';
            $f['created_user'] = $this->user;
            $f['updated_user'] = $this->user;
            $f['flgact'] = $this->getFlagAct($f_old->Antic);



            Helper::insTabla(Tab::GPC_CONTACTOS_CLIENTE, $f);

        }
    }


    public function insertBancos()
    {

        //insert into gpc_des.gpc_bancos(nombre,
        //codigo_pais,
        //digito_control,
        //created_user,
        //updated_user,
        //flgact)
        //select distinct banco,
        //'ES',
        //'00',
        //'JPT',
        //'JPT',
        //'A'
        //from gpc_des.gpc_bancos_temp;
    }


}


