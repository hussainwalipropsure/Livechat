<?php

$tpl = erLhcoreClassTemplate::getInstance('lhpermission/explorer.tpl.php');

if ($Params['user_parameters_unordered']['action'] == 1) {
    $filename = "permissions-" . date('Y-m-d') . ".csv";
    $fp = fopen('php://output', 'w');

    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=' . $filename);
    fputcsv($fp, [
        erTranslationClassLhTranslation::getInstance()->getTranslation('permission/explorer', 'Module'),
        erTranslationClassLhTranslation::getInstance()->getTranslation('permission/explorer', 'Permission'),
        erTranslationClassLhTranslation::getInstance()->getTranslation('permission/explorer', 'Explain'),
        erTranslationClassLhTranslation::getInstance()->getTranslation('permission/explorer', 'Used by URL')]);

    foreach (erLhcoreClassModules::getModuleList() as $key => $Module) {
        $moduleFunctions = erLhcoreClassModules::getModuleFunctions($key, array('extract_url' => true));
        if (count($moduleFunctions) > 0) {
            foreach ($moduleFunctions as $keyFunction => $function) {
                $url = [];
                if (isset($function['url'])) {
                    foreach ($function['url'] as $urlData) {
                        $url[] = erLhcoreClassSystem::getHost() . erLhcoreClassDesign::baseurl('/') . preg_replace('/^lh/', '', $urlData);
                    }
                }
                fputcsv($fp, [
                    '[' . $key . '] ' . $Module['name'],
                    $keyFunction,
                    $function['explain'],
                    implode("\n", $url)
                ]);
            }
        }
    }
    exit;
}

if ($Params['user_parameters_unordered']['action'] == 2) {

    $sysConfiguration = erLhcoreClassSystem::instance()->RequestURI = $_POST['url'];
    erLhcoreClassURL::resetInstance();

    $url = erLhcoreClassURL::getInstance();

    $currentModuleName = preg_replace('/[^a-zA-Z0-9\-_]/', '', $url->getParam( 'module' ));
    $currentView = preg_replace('/[^a-zA-Z0-9\-_]/', '', $url->getParam( 'function' ));

    $moduleFunctions = erLhcoreClassModules::getModuleFunctions('lh'.$currentModuleName, array('extract_url' => true));

    $requiredPermissions = [];

    foreach ($moduleFunctions as $permission => $moduleFunction) {
        if (isset($moduleFunction['url']) && in_array('lh'.$currentModuleName.'/'.$currentView, $moduleFunction['url'])) {
            $requiredPermissions[] = [
                'permission' => $permission,
                'explain' => $moduleFunction['explain']
            ];
        }
    }

    $moduleData = [
        'module' => 'lh'.$currentModuleName,
        'name' => erLhcoreClassModules::getModuleName('lh'.$currentModuleName),
        'permissions' => $requiredPermissions
    ];

    echo "<pre class='bg-secondary text-white p-2'>";
    echo htmlspecialchars(json_encode($moduleData,JSON_PRETTY_PRINT));
    echo "</pre>";

    exit;
}

if ($Params['user_parameters_unordered']['action'] == 3) {

    $tpl = erLhcoreClassTemplate::getInstance('lhpermission/permission_users.tpl.php');
    $tpl->set('users',[]);

    if (!isset($_POST['module']) || !isset($_POST['function'])){
        echo $tpl->fetch();
        exit;
    }

    // Get roles which grants this permissions
    $roles = erLhcoreClassModelRoleFunction::getList(['limit' => false, 'filter' => ['module' => (string)$_POST['module'], 'function' => (string)$_POST['function']]]);

    foreach (erLhcoreClassModelRoleFunction::getList(['limit' => false,'filter' => ['module' => $_POST['module'], 'function' => '*']]) as $roleFunction) {
        $roles[$roleFunction->id] = $roleFunction;
    }

    foreach (erLhcoreClassModelRoleFunction::getList(['limit' => false,'filter' => ['module' => '*', 'function' => '*']]) as $roleFunction) {
        $roles[$roleFunction->id] = $roleFunction;
    }

    $roleId = [];
    foreach ($roles as $role) {
        $roleId[] = $role->role_id;
    }

    if (empty($roleId)) {
        echo $tpl->fetch();
        exit;
    }

    $groupsRoles = erLhcoreClassModelGroupRole::getList(['limit' => false, 'filterin' => ['role_id' => $roleId]]);

    $groupIds = [];
    foreach ($groupsRoles as $groupRole) {
        $groupIds[] = $groupRole->group_id;
    }

    $groupsActive = erLhcoreClassModelGroup::getList(['filter' => ['disabled' => 0], 'filterin' => ['id' => $groupIds]]);

    $groupIds = array_keys($groupsActive);

    if (empty($groupIds)) {
        echo $tpl->fetch();
        exit;
    }

    $groupUsers = erLhcoreClassModelGroupUser::getList(['limit' => false, 'filterin' => ['group_id' => $groupIds]]);

    $userIds = [];
    foreach ($groupUsers as $groupUser) {
        $userIds[] = $groupUser->user_id;
    }

    if (empty($userIds)) {
        echo $tpl->fetch();
        exit;
    }

    $tpl->set('users',erLhcoreClassModelUser::getList(['limit' => false, 'filter' => ['disabled' => 0], 'filterin' => ['id' => $userIds]]));
    $tpl->set('roles',erLhcoreClassModelRole::getList(['limit' => false, 'filterin' => ['id' => $roleId]]));
    $tpl->set('groups',$groupsActive);

    echo $tpl->fetch();
    exit;
}

$Result['content'] = $tpl->fetch();

?>
