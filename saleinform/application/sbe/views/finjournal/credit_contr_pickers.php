<? switch($contr_type) {
	case 'CLIENT': {
		echo get_clients_vp($default_value = $value, $val_p = 'creditor_rid', $scr_p = 'creditor_name');
		break; 
	}
	case 'TOUROPERATOR': { 
		echo get_touroperators_vp($default_value = $value, $val_p = 'creditor_rid', $scr_p = 'creditor_name');
		break;
	}
	case 'FILIAL': {
		echo get_filials_vp($default_value = $value, $val_p = 'creditor_rid', $scr_p = 'creditor_name');
		break;
	} 
	case 'EMPLOYEER': {
		echo get_employeers_vp($default_value = $value, $val_p = 'creditor_rid', $scr_p = 'creditor_name');
		break;
	}
	DEFAULT: { 
		echo '';	
	}
} ?>