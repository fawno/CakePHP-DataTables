<?php
declare(strict_types=1);

namespace DataTables\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
use DataTables\DataTablesPlugin;

/**
 * Table helper
 */
class TableHelper extends HtmlHelper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    //protected $_defaultConfig = [];

		public function getTags ($block = null, string $theme = 'DataTables.dataTables.bootstrap') : string {
			$out = '';

			$out .= $this->script('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js', ['block' => $block, 'integrity' => 'sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==', 'crossorigin' => 'anonymous', 'referrerpolicy' => 'no-referrer']);
			$out .= $this->script('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap.min.js', ['block' => $block, 'integrity' => 'sha512-F0E+jKGaUC90odiinxkfeS3zm9uUT1/lpusNtgXboaMdA3QFMUez0pBmAeXGXtGxoGZg3bLmrkSkbK1quua4/Q==', 'crossorigin' => 'anonymous', 'referrerpolicy' => 'no-referrer']);
			$out .= $this->css('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css', ['block' => $block, 'integrity' => 'sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==', 'crossorigin' => 'anonymous', 'referrerpolicy' => 'no-referrer']);
			$out .= $this->css($theme ?? 'DataTables.dataTables.bootstrap', ['block' => $block]);

			return $out;
		}

		public function initTable (string $selector, array $options) {
			$template = '<script>$(function() { $(\'{{selector}}\').DataTable({{options}); });</script>';
			$template = '<script>$(function() { $(\'%s\').DataTable(%s); });</script>';
			$options += [
			];

			if (!empty($options['language']) and is_string($options['language'])) {
				if (!preg_match('~^\{.*\}$~', $options['language']) and is_file(DataTablesPlugin::I18N . $options['language'] . '.json')) {
					$options['language'] = file_get_contents(DataTablesPlugin::I18N . $options['language'] . '.json');
					$options['language'] = json_decode($options['language'], true);
				}
			}

			$options = json_encode($options);

			return sprintf($template, $selector, $options);
		}
}
