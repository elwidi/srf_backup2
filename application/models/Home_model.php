<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class home_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }

    function statistic()
    {
        if($this->session->userdata('leveluser_id')==2)
        {
            $this->db->select(" (select count(id) 
                                    from customer as c 
                                    left join 
                                    where leveluser_id=3 and supervisor_id=".$this->session->userdata('id')." and active=true 
                                    ) as salesman, 
                                (select count(c.id) 
                                    from customer as c
                                    left join stages as s on c.id=s.customer_id 
                                    where aspek_id=2 and irban_id=m.irban_id 
                                    ) as jml_tupoksi, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=3 and irban_id=m.irban_id 
                                    ) as jml_metode, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=4 and irban_id=m.irban_id 
                                    ) as jml_sdm, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=5 and irban_id=m.irban_id 
                                    ) as jml_sarana");
        }
        else
        {
            $this->db->select(" (select count(id) from temuan where aspek_id=1) as jml_keuangan, 
                                (select count(id) from temuan where aspek_id=2) as jml_tupoksi, 
                                (select count(id) from temuan where aspek_id=3) as jml_metode, 
                                (select count(id) from temuan where aspek_id=4) as jml_sdm, 
                                (select count(id) from temuan where aspek_id=5) as jml_sarana");
        }
        
        $this->db->from('temuan as t');
        $this->db->join('tim as m', 't.tim_id=m.id', 'left');
        $this->db->where('deleted_date is null');
        
        if($this->session->userdata('jabatan')!='inspektur' && $this->session->userdata('jabatan')!='wakil inspektur' && $this->session->userdata('jabatan')!='root' && $this->session->userdata('jabatan')!='tim penilai')
            $this->db->where('irban_id', $this->session->userdata('irban_id'));
            
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->row();
        else
            return null;
    }
    
    function temuanPerBulan()
    {
        if($this->session->userdata('jabatan')!='inspektur' && $this->session->userdata('jabatan')!='wakil inspektur' && $this->session->userdata('jabatan')!='root' && $this->session->userdata('jabatan')!='tim penilai')
        {
            $this->db->select(" bulan, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=1 and bulan=t.bulan and irban_id=m.irban_id 
                                    ) as jml_keuangan, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=2 and bulan=t.bulan and irban_id=m.irban_id 
                                    ) as jml_tupoksi, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=3 and bulan=t.bulan and irban_id=m.irban_id 
                                    ) as jml_metode, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=4 and bulan=t.bulan and irban_id=m.irban_id 
                                    ) as jml_sdm, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=5 and bulan=t.bulan and irban_id=m.irban_id 
                                    ) as jml_sarana");
        }
        else
        {
            $this->db->select(" bulan, 
                                (select count(id) from temuan where aspek_id=1 and bulan=t.bulan) as jml_keuangan, 
                                (select count(id) from temuan where aspek_id=2 and bulan=t.bulan) as jml_tupoksi, 
                                (select count(id) from temuan where aspek_id=3 and bulan=t.bulan) as jml_metode, 
                                (select count(id) from temuan where aspek_id=4 and bulan=t.bulan) as jml_sdm, 
                                (select count(id) from temuan where aspek_id=5 and bulan=t.bulan) as jml_sarana");
        }
        
        $this->db->from('temuan as t');
        $this->db->join('tim as m', 't.tim_id=m.id', 'left');
        $this->db->where("tahun = '".date('Y')."'");
        $this->db->where('deleted_date is null');
        
        if($this->session->userdata('jabatan')!='inspektur' && $this->session->userdata('jabatan')!='wakil inspektur' && $this->session->userdata('jabatan')!='root' && $this->session->userdata('jabatan')!='tim penilai')
            $this->db->where('irban_id', $this->session->userdata('irban_id'));
        
        $this->db->group_by("bulan");
        $this->db->order_by("bulan");
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function temuanPerTahun()
    {
        if($this->session->userdata('jabatan')!='inspektur' && $this->session->userdata('jabatan')!='wakil inspektur' && $this->session->userdata('jabatan')!='root' && $this->session->userdata('jabatan')!='tim penilai')
        {
            $this->db->select(" tahun, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=1 and tahun=t.tahun and irban_id=m.irban_id 
                                    ) as jml_keuangan, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=2 and tahun=t.tahun and irban_id=m.irban_id 
                                    ) as jml_tupoksi, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=3 and tahun=t.tahun and irban_id=m.irban_id 
                                    ) as jml_metode, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=4 and tahun=t.tahun and irban_id=m.irban_id 
                                    ) as jml_sdm, 
                                (select count(temuan.id) 
                                    from temuan 
                                    left join tim on temuan.tim_id=tim.id 
                                    where aspek_id=5 and tahun=t.tahun and irban_id=m.irban_id 
                                    ) as jml_sarana");
        }
        else
        {
            $this->db->select(" tahun, 
                                (select count(id) from temuan where aspek_id=1 and tahun=t.tahun) as jml_keuangan, 
                                (select count(id) from temuan where aspek_id=2 and tahun=t.tahun) as jml_tupoksi, 
                                (select count(id) from temuan where aspek_id=3 and tahun=t.tahun) as jml_metode, 
                                (select count(id) from temuan where aspek_id=4 and tahun=t.tahun) as jml_sdm, 
                                (select count(id) from temuan where aspek_id=5 and tahun=t.tahun) as jml_sarana");
        }
        
        $this->db->from('temuan as t');
        $this->db->join('tim as m', 't.tim_id=m.id', 'left');
        $this->db->where('deleted_date is null');
        
        if($this->session->userdata('jabatan')!='inspektur' && $this->session->userdata('jabatan')!='wakil inspektur' && $this->session->userdata('jabatan')!='root' && $this->session->userdata('jabatan')!='tim penilai')
            $this->db->where('irban_id', $this->session->userdata('irban_id'));
        
        $this->db->group_by("tahun");
        $this->db->order_by("tahun");
        $rec = $this->db->get();
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function keuanganPerInstansi()
    {
        if($this->session->userdata('jabatan')!='inspektur' && $this->session->userdata('jabatan')!='wakil inspektur' && $this->session->userdata('jabatan')!='root' && $this->session->userdata('jabatan')!='tim penilai')
        {
            $rec = $this->db->query('
                                    select nama_instansi, sum(total) as total from (
                                    select i.nama as nama_instansi, (sum(h.nilai_pencegahan) + sum(h.nilai_pengembalian)) as total 
                                    from historytemuan as h 
                                    left join temuan as t on h.temuan_id=t.id 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and m.irban_id = '.$this->session->userdata('irban_id').' and 
                                            deleted_date is null and DATE_FORMAT(tanggal_penugasan, \'%Y\')=\''.date('Y').'\' and 
                                            h.id = (select ht.id 
                                                    from historytemuan ht
                                                    left join temuan tm on ht.temuan_id=tm.id 
                                                    WHERE   ht.temuan_id=h.temuan_id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                    order by ht.id desc 
                                                    limit 1)
                                    group by t.instansi_id 
                                    UNION
                                    select i.nama as nama_instansi, (sum(t.nilai_pencegahan) + sum(t.nilai_pengembalian)) as total 
                                    from temuan as t 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and m.irban_id = '.$this->session->userdata('irban_id').' and 
                                            deleted_date is null and DATE_FORMAT(tanggal_penugasan, \'%Y\')=\''.date('Y').'\' and 
                                            t.id not in (select ht.temuan_id 
                                                from historytemuan ht 
                                                left join temuan tm on ht.temuan_id=tm.id 
                                                WHERE   ht.temuan_id=t.id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                group by ht.temuan_id)
                                    group by t.instansi_id 
                                    ) a 
                                    group by nama_instansi 
                                    order by nama_instansi');
        }
        else
        {
            $rec = $this->db->query('
                                    select nama_instansi, sum(total) as total from (
                                    select i.nama as nama_instansi, (sum(h.nilai_pencegahan) + sum(h.nilai_pengembalian)) as total 
                                    from historytemuan as h 
                                    left join temuan as t on h.temuan_id=t.id 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and DATE_FORMAT(tanggal_penugasan, \'%Y\')=\''.date('Y').'\' and 
                                            deleted_date is null and 
                                            h.id = (select ht.id 
                                                    from historytemuan ht
                                                    left join temuan tm on ht.temuan_id=tm.id 
                                                    WHERE   ht.temuan_id=h.temuan_id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                    order by ht.id desc 
                                                    limit 1)
                                    group by t.instansi_id 
                                    UNION
                                    select i.nama as nama_instansi, (sum(t.nilai_pencegahan) + sum(t.nilai_pengembalian)) as total 
                                    from temuan as t 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and DATE_FORMAT(tanggal_penugasan, \'%Y\')=\''.date('Y').'\' and 
                                            deleted_date is null and 
                                            t.id not in (select ht.temuan_id 
                                                from historytemuan ht 
                                                left join temuan tm on ht.temuan_id=tm.id 
                                                WHERE   ht.temuan_id=t.id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                group by ht.temuan_id)
                                    group by t.instansi_id 
                                    ) a 
                                    group by nama_instansi 
                                    order by nama_instansi');
        }
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
    
    function keuanganPerTahun()
    {
        if($this->session->userdata('jabatan')!='inspektur' && $this->session->userdata('jabatan')!='wakil inspektur' && $this->session->userdata('jabatan')!='root' && $this->session->userdata('jabatan')!='tim penilai')
        {
            $rec = $this->db->query('
                                    select tahun, sum(total) as total from (
                                    select DATE_FORMAT(tanggal_penugasan, \'%Y\') as tahun, (sum(h.nilai_pencegahan) + sum(h.nilai_pengembalian)) as total 
                                    from historytemuan as h 
                                    left join temuan as t on h.temuan_id=t.id 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and m.irban_id = '.$this->session->userdata('irban_id').' and 
                                            deleted_date is null and 
                                            h.id = (select ht.id 
                                                    from historytemuan ht
                                                    left join temuan tm on ht.temuan_id=tm.id 
                                                    WHERE   ht.temuan_id=h.temuan_id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                    order by ht.id desc 
                                                    limit 1)
                                    group by DATE_FORMAT(tanggal_penugasan, \'%Y\') 
                                    UNION
                                    select DATE_FORMAT(tanggal_penugasan, \'%Y\') as tahun, (sum(t.nilai_pencegahan) + sum(t.nilai_pengembalian)) as total 
                                    from temuan as t 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and m.irban_id = '.$this->session->userdata('irban_id').' and 
                                            deleted_date is null and 
                                            t.id not in (select ht.temuan_id 
                                                from historytemuan ht 
                                                left join temuan tm on ht.temuan_id=tm.id 
                                                WHERE   ht.temuan_id=t.id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                group by ht.temuan_id)
                                    group by DATE_FORMAT(tanggal_penugasan, \'%Y\') 
                                    ) a 
                                    group by tahun 
                                    order by tahun');
        }
        else
        {
            $rec = $this->db->query('
                                    select tahun, sum(total) as total from (
                                    select DATE_FORMAT(tanggal_penugasan, \'%Y\') as tahun, (sum(h.nilai_pencegahan) + sum(h.nilai_pengembalian)) as total 
                                    from historytemuan as h 
                                    left join temuan as t on h.temuan_id=t.id 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and 
                                            deleted_date is null and 
                                            h.id = (select ht.id 
                                                    from historytemuan ht
                                                    left join temuan tm on ht.temuan_id=tm.id 
                                                    WHERE   ht.temuan_id=h.temuan_id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                    order by ht.id desc 
                                                    limit 1)
                                    group by DATE_FORMAT(tanggal_penugasan, \'%Y\') 
                                    UNION
                                    select DATE_FORMAT(tanggal_penugasan, \'%Y\') as tahun, (sum(t.nilai_pencegahan) + sum(t.nilai_pengembalian)) as total 
                                    from temuan as t 
                                    left join instansi as i on t.instansi_id=i.id 
                                    left join tim as m on t.tim_id=m.id 
                                    where   t.aspek_id=1 and 
                                            deleted_date is null and 
                                            t.id not in (select ht.temuan_id 
                                                from historytemuan ht 
                                                left join temuan tm on ht.temuan_id=tm.id 
                                                WHERE   ht.temuan_id=t.id and tm.instansi_id=t.instansi_id and tm.aspek_id=1 
                                                group by ht.temuan_id)
                                    group by DATE_FORMAT(tanggal_penugasan, \'%Y\') 
                                    ) a 
                                    group by tahun 
                                    order by tahun');
        }
        
        if ($rec->num_rows() > 0)
            return $rec->result();
        else
            return null;
    }
}