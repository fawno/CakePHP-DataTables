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

			$out .= $this->script('https://cdn.datatables.net/2.1.8/js/dataTables.min.js', ['block' => $block]);
			$out .= $this->script('https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap.js', ['block' => $block]);
			$out .= $this->css('https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap.min.css', ['block' => $block,]);
			$out .= $this->css($theme ?? 'DataTables.dataTables.bootstrap', ['block' => $block]);

			return $out;
		}

		public function initTable (string $selector, array $options) {
			$template = '<script>$(function() { $(\'{{selector}}\').DataTable({{options}); });</script>';
			$template = '<script>$(function() { $(\'%s\').DataTable(%s); });</script>';
			$options += [
			];

			$language = $options['language'] ?? '';
			if (is_string($language) and preg_match('~^[a-z\-]{2,}$~i', $language)) {
				if (is_file(DataTablesPlugin::I18N . $language . '.json')) {
					$options['language'] = ['url' => $this->Url->build('/data_tables/i18n/' . $language . '.json')];
				}
			}

			if (isset($options['footerCallback'])) {
				$options['footerCallback'] = preg_replace('~[\r\n\t]~', '', $options['footerCallback']);
			}
			$options = json_encode($options);

			$options = preg_replace('~("createdRow":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("drawCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("footerCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("formatNumber":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("headerCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("infoCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("initComplete":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("preDrawCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("rowCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("stateLoadCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("stateLoadParams":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("stateLoaded":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("stateSaveCallback":)"([^\"]+)"~', '$1$2', $options);
			$options = preg_replace('~("stateSaveParams":)"([^\"]+)"~', '$1$2', $options);

			return sprintf($template, $selector, $options);
		}
	}
