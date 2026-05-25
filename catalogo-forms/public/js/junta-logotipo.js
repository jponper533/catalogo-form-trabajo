class Logotipo extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="48.9621696 57.0514679 893.7146492 836.4701996" preserveAspectRatio="xMidYMid meet" xml:space="preserve">
<g>
	<g>
		<g>
			<polygon class="st0" points="442.2586975,57.0514679 609.3013306,57.0514679 942.6768188,893.5216675 774.5802002,893.5216675         "/>
			<polygon class="st1" points="609.3135376,57.0514679 442.269989,57.0514679 48.9621696,893.5216675 216.004837,893.5216675         "/>
			<g>
				<path class="st1" d="M774.5827637,893.5212402h168.1253052      c-90.5684204-136.1516113-245.3406982-225.6095581-421.0678711-225.6095581      c-27.0484314,0-53.5555725,2.1069946-79.3797913,6.1786499v130.6849365      c25.6817017-5.4953003,52.5589905-8.5129395,80.0054016-8.5129395      C619.4117432,796.2623291,707.8731079,833.0475464,774.5827637,893.5212402"/>
			</g>
		</g>
		
	</g>
</g>
</svg>
`;
    }
}
customElements.define('junta-logotipo', Logotipo);
