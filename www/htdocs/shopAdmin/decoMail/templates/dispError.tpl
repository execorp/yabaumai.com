{include file=$smarty.const.header_admin}
{$jsInclude}
<div class="massage">
���̓��e�̓f�R���[���Ƃ��đ��M�ł��܂���B<br>
{if $sendForm.errors}
    {foreach from=$sendForm.errors item=error}
    {$error}<br/>
    {/foreach}
{/if}
{if $e > 0}���̓o�^��HTML{literal}�{{/literal}�����������邽�߁A���M�ł��܂���B<br>{/if}
{if $r == 1}�o�^���������܂����B{/if}
{if $r == 2}���M���J�n���܂����B���M�����܂Ő����K�v�ł��B<br>�������܂ŉ摜�͕ύX���Ȃ��ł��������B{/if}
{if $r == 3}�摜�̃A�b�v���[�h���������܂����B{/if}
{if $r == 4}�摜�̍폜���������܂����B{/if}
{if $r == 5}���M�����ƌ������m�F������A�o�^���đ��M�������ĉ������B{/if}
{if $r == 6}�ʏ탁�[�� �� �f�R���[�� �̍��v���������܂��B{/if}
{if $r == 7}�Y�t�摜�ꗗ�ȊO�̉摜���}������Ă��܂��B{/if}
{if $r == 8}�ʏ탁�[�� �� �f�R���[�� �̂����ꂩ��͓��͂��ĉ������B{/if}
{if $r == 9}���M���⌏���͕K�����͂��ĉ������B{/if}
</div>
        <form action="#">
                <input type=button name=back value="�@�߁@��@" onclick="history.back(); return false;">
        </form>
{include file=$smarty.const.footer_admin}
