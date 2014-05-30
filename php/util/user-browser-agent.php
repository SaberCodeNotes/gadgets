<?php
class userBrowserAgent {
	/**
	 * 获取UserInfo
	 *
	 * @param string $type
	 *        	if type == all, return array. else, return string.
	 *        	可选参数：
	 *        	all = 全部
	 *        	host = 域名
	 *        	language = 语言
	 *        	ip = 客户IP
	 *        	browser = 浏览器信息
	 *        	system = 系统信息
	 *        	referer = 从哪个URL跳转过来的
	 *        	method = 请求页面所用方法 get,post,head,put
	 */
	public function userAgent($type = 'all') {
		$agentInfo = array (
				'host' => $_SERVER ['HTTP_HOST'],
				'language' => $_SERVER ['HTTP_ACCEPT_LANGUAGE'],
				'ip' => $_SERVER ['REMOTE_ADDR'],
				'browser' => $this->getBrowser (),
				'system' => $this->getSystem (),
				'referer' => $_SERVER ['HTTP_REFERER'],
				'method' => $_SERVER ['REQUEST_METHOD'] 
		);
		if (strtolower ( $type ) == 'all') {
			return $agentInfo;
		} else {
			return $agentInfo [strtolower ( $type )];
		}
	}
	
	/**
	 * 通过正则获取浏览器信息
	 */
	function getBrowser() {
		$Agent = $_SERVER ['HTTP_USER_AGENT'];
		$browseragent = "";
		$browserversion = "";
		if (ereg ( 'MSIE ([0-9].[0-9]{1,2})', $Agent, $version )) {
			$browserversion = $version [1];
			$browseragent = "Internet Explorer";
		} else if (ereg ( 'Opera/([0-9]{1,2}.[0-9]{1,2})', $Agent, $version )) {
			$browserversion = $version [1];
			$browseragent = "Opera";
		} else if (ereg ( 'Firefox/([0-9.]{1,5})', $Agent, $version )) {
			$browserversion = $version [1];
			$browseragent = "Firefox";
		} else if (ereg ( 'Chrome/([0-9.]{1,3})', $Agent, $version )) {
			$browserversion = $version [1];
			$browseragent = "Chrome";
		} else if (ereg ( 'Safari/([0-9.]{1,3})', $Agent, $version )) {
			$browseragent = "Safari";
			$browserversion = "";
		} else {
			$browserversion = "";
			$browseragent = "Unknown";
		}
		return $browseragent . " " . $browserversion;
	}
	
	/**
	 * 通过正则获取操作系统信息
	 */
	function getSystem() {
		$Agent = $_SERVER ['HTTP_USER_AGENT'];
		$browserplatform = '';
		if (eregi ( 'win 9x', $Agent ) && strpos ( $Agent, '4.90' )) {
			$browserplatform = "Windows ME";
		}
		if (eregi ( 'win', $Agent )) {
			if (strpos ( $Agent, '95' )) {
				$browserplatform = "Windows 95";
			} elseif (ereg ( '98', $Agent )) {
				$browserplatform = "Windows 98";
			} elseif (eregi ( 'nt 5.0', $Agent )) {
				$browserplatform = "Windows 2000";
			} elseif (eregi ( 'nt 5.1', $Agent )) {
				$browserplatform = "Windows XP";
			} elseif (eregi ( 'nt 6.0', $Agent )) {
				$browserplatform = "Windows Vista";
			} elseif (eregi ( 'nt 6.1', $Agent )) {
				$browserplatform = "Windows 7";
			} elseif (ereg ( '32', $Agent )) {
				$browserplatform = "Windows 32";
			} elseif (eregi ( 'nt', $Agent )) {
				$browserplatform = "Windows NT";
			}
		} elseif (eregi ( 'Mac OS', $Agent )) {
			$browserplatform = "Mac OS";
		} elseif (eregi ( 'linux', $Agent )) {
			$browserplatform = "Linux";
		} elseif (eregi ( 'unix', $Agent )) {
			$browserplatform = "Unix";
		} elseif (eregi ( 'sun', $Agent ) && eregi ( 'os', $Agent )) {
			$browserplatform = "SunOS";
		} elseif (eregi ( 'ibm', $Agent ) && eregi ( 'os', $Agent )) {
			$browserplatform = "IBM OS/2";
		} elseif (eregi ( 'Mac', $Agent ) && eregi ( 'PC', $Agent )) {
			$browserplatform = "Macintosh";
		} elseif (eregi ( 'PowerPC', $Agent )) {
			$browserplatform = "PowerPC";
		} elseif (eregi ( 'AIX', $Agent )) {
			$browserplatform = "AIX";
		} elseif (eregi ( 'HPUX', $Agent )) {
			$browserplatform = "HPUX";
		} elseif (eregi ( 'NetBSD', $Agent )) {
			$browserplatform = "NetBSD";
		} elseif (eregi ( 'BSD', $Agent )) {
			$browserplatform = "BSD";
		} elseif (ereg ( 'OSF1', $Agent )) {
			$browserplatform = "OSF1";
		} elseif (ereg ( 'IRIX', $Agent )) {
			$browserplatform = "IRIX";
		} elseif (eregi ( 'FreeBSD', $Agent )) {
			$browserplatform = "FreeBSD";
		}
		if ($browserplatform == '') {
			$browserplatform = "Unknown";
		}
		return $browserplatform;
	}
}
?>