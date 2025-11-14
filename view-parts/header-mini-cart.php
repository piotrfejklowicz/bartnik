<div id="mini-cart-container">
  <?php
  // Dołącz zawartość koszyka przy pierwszym załadowaniu strony
  require __DIR__ . '/header-mini-cart-content.php';
  ?>
</div>

<style>
.cart-widget .mini-cart {
  position: absolute;
  top: 100%;
	right: -40px;
  z-index: 190;
	margin-top: -10px;
	opacity: 0;
  visibility: hidden;
  transition: opacity 0.23s ease-in-out, visibility 0.23s ease-in-out;
}

.mini-cart,
.mini-cart * {
    box-sizing: border-box;
}
.mini-cart {
    background: var(--standard-colors-white, #ffffff);
    border-radius: 10px;
    border-style: solid;
    border-color: var(--brand-colors-tangerine-yellow, #fecc00);
    border-width: 3px 0px 0px 0px;
    width: 299px;
    height: 517px;
    position: relative;
    box-shadow: 0px 1.9px 3.62px 0px rgba(0, 0, 0, 0.02),
    0px 5.26px 10.02px 0px rgba(0, 0, 0, 0.04),
    0px 12.66px 24.12px 0px rgba(0, 0, 0, 0.05),
    0px 42px 80px 0px rgba(0, 0, 0, 0.07);
    overflow: hidden;

	.buttons {
		display: flex;
		flex-direction: column;
		gap: 10px;
		align-items: flex-start;
		justify-content: flex-start;
		width: 260px;
		position: absolute;
		left: 19px;
		top: 383px;
	}
	.button {
		background: var(--standard-colors-grey-ii, #d6d5d6);
		border-radius: 10px;
		padding: 0px 25px 0px 25px;
		display: flex;
		flex-direction: row;
		gap: 10px;
		align-items: center;
		justify-content: center;
		align-self: stretch;
		flex-shrink: 0;
		height: 45px;
		position: relative;
	}
	.zobacz-koszyk {
		color: var(--brand-colors-bistre, #3c291e);
		text-align: left;
		font-family: "Poppins-Medium", sans-serif;
		font-size: 14px;
		font-weight: 500;
		position: relative;
		display: flex;
		align-items: flex-end;
		justify-content: flex-start;
	}
	.button2 {
		background: var(--brand-colors-tangerine-yellow, #fecc00);
		border-radius: 10px;
		border-style: solid;
		border-color: transparent;
		border-width: 2px;
		padding: 0px 25px 0px 25px;
		display: flex;
		flex-direction: row;
		gap: 10px;
		align-items: center;
		justify-content: center;
		align-self: stretch;
		flex-shrink: 0;
		height: 45px;
		position: relative;
		box-shadow: 0px 0.72px 1.41px 0px rgba(254, 204, 0, 0.02),
		0px 1.82px 3.56px 0px rgba(254, 204, 0, 0.03),
		0px 3.72px 7.27px 0px rgba(254, 204, 0, 0.04),
		0px 7.67px 14.97px 0px rgba(254, 204, 0, 0.05),
		0px 21px 41px 0px rgba(254, 204, 0, 0.07);
	}
	.z-zam-wienie {
		color: var(--brand-colors-bistre, #3c291e);
		text-align: left;
		font-family: "Poppins-Medium", sans-serif;
		font-size: 14px;
		font-weight: 500;
		position: relative;
		display: flex;
		align-items: flex-end;
		justify-content: flex-start;
	}
	.summary {
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
		width: 259px;
		position: absolute;
		left: 20px;
		top: 336px;
	}
	.suma {
		color: var(--standard-colors-black, #111111);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 16px;
		font-weight: 700;
		position: relative;
	}
	._51-50-z {
		color: var(--standard-colors-black, #111111);
		text-align: right;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 16px;
		font-weight: 700;
		position: relative;
	}
	.horizontal-divider {
		background: var(--standard-colors-grey-i, #ededed);
		width: 264px;
		height: 2px;
		position: absolute;
		left: 15px;
		bottom: 193px;
	}
	.horizontal-divider2 {
		background: var(--brand-colors-tangerine-yellow, #fecc00);
		width: 47.29px;
		height: 1.89px;
		position: absolute;
		left: 15px;
		bottom: 192.96px;
	}
	.products {
		display: flex;
		flex-direction: column;
		gap: 8px;
		align-items: flex-start;
		justify-content: flex-start;
		width: 264px;
		position: absolute;
		left: 15px;
		top: 20px;
	}
	.product-01 {
		display: flex;
		flex-direction: row;
		gap: 0px;
		align-items: center;
		justify-content: flex-start;
		align-self: stretch;
		flex-shrink: 0;
		position: relative;
	}
	.image {
		border-radius: 5px;
		flex-shrink: 0;
		width: 65px;
		height: 65px;
		position: relative;
		object-fit: cover;
		margin-bottom: -1px;
	}
	.frame-1756 {
		display: flex;
		flex-direction: column;
		gap: 10px;
		align-items: flex-start;
		justify-content: flex-start;
		flex-shrink: 0;
		position: absolute;
		left: 4.29px;
		top: 5.16px;
	}
	.label {
		background: var(--other-color-red, #fb0018);
		border-radius: 2px;
		padding: 2px;
		display: flex;
		flex-direction: column;
		gap: 4.16px;
		align-items: center;
		justify-content: center;
		flex-shrink: 0;
		position: relative;
	}
	._10 {
		color: var(--standard-colors-white, #ffffff);
		text-align: center;
		font-family: "Poppins-SemiBold", sans-serif;
		font-size: 8px;
		font-weight: 600;
		position: relative;
	}
	.descp {
		padding: 0px 0px 0px 15px;
		display: flex;
		flex-direction: column;
		gap: 5px;
		align-items: flex-start;
		justify-content: flex-start;
		flex-shrink: 0;
		width: 178px;
		position: relative;
	}
	.cud-mi-d-jagoda-250-g {
		color: var(--standard-colors-black, #111111);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 12px;
		line-height: 14px;
		font-weight: 700;
		position: relative;
		align-self: stretch;
	}
	.price {
		display: flex;
		flex-direction: row;
		gap: 5px;
		align-items: center;
		justify-content: flex-start;
		align-self: stretch;
		flex-shrink: 0;
		position: relative;
	}
	._15-z {
		color: var(--standard-colors-grey-iii, #999598);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 12px;
		font-weight: 700;
		text-decoration: line-through;
		position: relative;
	}
	._13-z {
		color: var(--other-color-red, #fb0018);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 14px;
		font-weight: 700;
		position: relative;
	}
	.delete {
		flex-shrink: 0;
		width: 10px;
		height: 10px;
		position: absolute;
		right: 0px;
		top: 11px;
		overflow: visible;
	}
	.product-2 {
		display: flex;
		flex-direction: row;
		gap: 0px;
		align-items: center;
		justify-content: flex-start;
		align-self: stretch;
		flex-shrink: 0;
		position: relative;
	}
	.cud-mi-d-i-hibiskus-z-pomara-cz {
		color: var(--standard-colors-black, #111111);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 12px;
		line-height: 14px;
		font-weight: 700;
		position: relative;
		align-self: stretch;
	}
	._12-50-z {
		color: var(--brand-colors-bistre, #3c291e);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 12px;
		font-weight: 700;
		position: relative;
		align-self: stretch;
	}
	.delete2 {
		flex-shrink: 0;
		width: 10px;
		height: 10px;
		position: absolute;
		right: 0px;
		top: 11px;
		overflow: visible;
	}
	.product-3 {
		display: flex;
		flex-direction: row;
		gap: 0px;
		align-items: center;
		justify-content: flex-start;
		align-self: stretch;
		flex-shrink: 0;
		position: relative;
	}
	.cud-mi-d-pigwowiec-japo-ski-z-dzik-r-250-g {
		color: var(--standard-colors-black, #111111);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 12px;
		line-height: 14px;
		font-weight: 700;
		position: relative;
		align-self: stretch;
	}
	._13-00-z {
		color: var(--brand-colors-bistre, #3c291e);
		text-align: left;
		font-family: "ChakraPetch-Bold", sans-serif;
		font-size: 12px;
		font-weight: 700;
		position: relative;
		align-self: stretch;
	}
	.delete3 {
		flex-shrink: 0;
		width: 10px;
		height: 10px;
		position: absolute;
		right: 0px;
		top: 11px;
		overflow: visible;
	}
	.product-4 {
		display: flex;
		flex-direction: row;
		gap: 0px;
		align-items: center;
		justify-content: flex-start;
		align-self: stretch;
		flex-shrink: 0;
		position: relative;
	}
	.delete4 {
		flex-shrink: 0;
		width: 10px;
		height: 10px;
		position: absolute;
		right: 0px;
		top: 11px;
		overflow: visible;
	}
	a.product-link-wrapper {
		margin: 1px;
		.cud-mi-d-jagoda-250-g, .title {
			transition: color .17s ease-in-out;
		}
		img.delete:hover {
			filter: brightness(0.15);
		}
	}
	a.product-link-wrapper:hover {
		outline: solid 1px #fecc00;
		outline-offset: 0px;
		/*opacity: .8;*/
		background: #fecc0022;
		&:not(:has(img.delete:hover)) {
			.cud-mi-d-jagoda-250-g, .title {
				text-decoration: underline;
				color: #836d47;
			}
		}
		&:has(img.delete:hover) {
			outline: solid 1px #fb0018;
			background: #fb001822;
		}
	}
}
</style>