{include file=$smarty.const.header_admin}
{$jsInclude}
<div class="massage">
この内容はデコメールとして送信できません。<br>
{if $sendForm.errors}
    {foreach from=$sendForm.errors item=error}
    {$error}<br/>
    {/foreach}
{/if}
{if $e > 0}この登録はHTML{literal}本{/literal}文が長すぎるため、送信できません。<br>{/if}
{if $r == 1}登録が完了しました。{/if}
{if $r == 2}送信を開始しました。送信完了まで数分必要です。<br>※完了まで画像は変更しないでください。{/if}
{if $r == 3}画像のアップロードが完了しました。{/if}
{if $r == 4}画像の削除が完了しました。{/if}
{if $r == 5}送信条件と件数を確認した後、登録して送信を押して下さい。{/if}
{if $r == 6}通常メール と デコメール の合計が長すぎます。{/if}
{if $r == 7}添付画像一覧以外の画像が挿入されています。{/if}
{if $r == 8}通常メール か デコメール のいずれか一つは入力して下さい。{/if}
{if $r == 9}送信元や件名は必ず入力して下さい。{/if}
</div>
        <form action="#">
                <input type=button name=back value="　戻　る　" onclick="history.back(); return false;">
        </form>
{include file=$smarty.const.footer_admin}
