<?php
		// { Enable profiler for admin only
		$currentSESS = $this->session->userdata('_SI_');
			$this->output->enable_profiler(True);		
		}
		else $this->output->enable_profiler(False);
		// } Enable profiler for admin only
	/**