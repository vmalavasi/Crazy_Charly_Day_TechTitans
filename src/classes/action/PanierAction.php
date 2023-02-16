<?php

namespace iutnc\crazyCharlieDay\action;

class PanierAction
{
    /**
     * @return string
     */

    public function execute(): string{
        $html = '<h2>Panier</h2> 
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
              <th>Supprimer</th>
                    </tr>
                </thead>';

        if(isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier'] as $produit) {
                $html .= '
			<tbody>
				<tr id = ' . htmlspecialchars($produit['id']) . '>
					<td>' . htmlspecialchars($produit['Nom']) . '</td>
					<td class="price">' . htmlspecialchars($produit['Prix']) . '</td>
					<td><input class="quantity" type="number" min="1" value="1" onchange="updateTotal()"></td>
          <td><button class="delete" onclick="deleteProduct(1)">🗑️</button></td>
				</tr>
				';
            }
        }

        $html .= '</tbody>
		</table>
		<div class="total-sum">Somme totale : <span id="total">60.00</span> €</div>
		<button class="validate-button">Valider le panier</button>
		';

        return $html;
    }
}