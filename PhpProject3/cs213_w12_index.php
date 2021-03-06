
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>CS 213 Week 12/Check Out</title>
</head>

<body>
    <form id="myForm" action="purchaseReview.php" method="POST">
        <div class="all">
            <div class="logo">
                <img src="logo-mi.png" alt="logo" />
            </div>
            <div class="header">
                <p>Rua Mto Francisco Antonelo, 1452, Lj 1, Fanny</p>
                <p>Curitiba - PR / CEP: 81030-100</p>
            </div>
            <h2>Personal/Shipping Address</h2>
            <div class="names">
                <div class="firstCol">
                    First Name: <input id="names" name="firstName" onblur="upperText()" onInput="validationName(this.value, 'name1')" type="text" size="20" />
                    <span class="name1" style='color:red'>Invalid First Name</span>
                </div>
                <div class="">
                    Last Name: <input id="names" name="lastName" onblur="upperText()" onInput="validationName(this.value, 'name2')" type="text" size="20" />
                    <span class="name2" style='color:red'>Invalid Last Name</span>
                </div>
                <div class="firstCol">
                    Address 1: <input name="address1" oninput="validationAddress(this.value, 'address1')" type="text" size="20" />
                    <span class="address1" style='color:red'>Invalid Address 1</span>
                </div>
                <div class="secondCol">
                    Address 2: <input name="address2" onInput="validationAddress(this.value, 'address2')" type="text" size="20" />
                    <span class="address2" style='color:red'>Invalid Address 2</span>
                </div>
                <div class="firstCol">
                    City: <input name="city" onInput="validationName(this.value, 'city')" type="text" size="10" />
                    <span class="city" style='color:red'>Invalid City</span>
                </div>
                <div id="state">
                    State:
                    <select name="state">
                        <option value="AK">AK</option>
                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="IA">IA</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MO">MO</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>
                        <option value="NE">NE</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>
                        <option value="WA">WA</option>
                        <option value="WI">WI</option>
                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                    </select>
                </div>
                <div class="">
                    ZIP: <input name="zip" onInput="validationZip(this.value, 'zip')" type="text" size="5" />
                    <span class="zip" style='color:red'>Invalid ZIP</span>
                </div>
                <div>
                    Phone: <input name="phone" onInput="validationPhone(this.value, 'phone')" type="text" size="10" />
                    <span class="phone" style='color:red'>Invalid Phone</span>
                </div>

            </div>
            <h2>Check Out</h2>

            <div class="form">
                <table>
                    <tr>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Description of the Products
                        </th>
                        <th>
                            Product Image
                        </th>
                        <th>
                            Unit Price
                        </th>
                        <th>
                            Total Price
                        </th>

                    </tr>
                    <tr>
                        <td>
                            <input name="qty1" id="qty1" class="inputQty" onInput="totalItem();" type="number" min="0" max="999" value="0" />
                            <div id="outWarnQty"></div>
                        </td>
                        <td>
                            Desktop HP Core I5, 1TB Hard disk, 8GB memory, DVD-RW, Windows 10 Pro, Office 2016 Pro, 36m warranty, Monitor 21,5"
                        </td>
                        <td>
                            <img class="img-form" src="deskhp.png" alt="desk hp" />
                        </td>
                        <td class="unitPrice">
                            <span class="unitPriceDiv">U$ 799.00</span>
                        </td>
                        <td class="totalPrice">
                            <div id="outTotalPrice">
                            </div>

                        </td>

                    </tr>

                    <tr>
                        <td>
                            <input name="qty2" id="qty2" class="inputQty" onInput="totalItem2();" type="number" min="0" max="999" value="0" />
                            <div id="outWarnQty"></div>
                        </td>
                        <td>
                            Notebook HP Core I3, 500GB Hard disk, 4GB memory, DVD-RW, Windows 10 Pro, Office 2016 Pro, 36m warranty, Screen 14"
                        </td>
                        <td>
                            <img class="img-form" src="notehp.jpg" alt="note hp" />
                        </td>
                        <td class="unitPrice">
                            <span class="unitPriceDiv">U$ 499.00</span>
                        </td>
                        <td class="totalPrice">
                            <div id="outTotalPrice2">
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input name="qty3" id="qty3" class="inputQty" onInput="totalItem3();" type="number" min="0" max="999" value="0" />
                            <div id="outWarnQty"></div>
                        </td>
                        <td>
                            Tablet HP 7.1, 7" - Proc A7 Quad Core, 8GB, Cam 2MP, Wi-Fi, Android 4.2
                        </td>
                        <td>
                            <img class="img-form" src="tablethp.jpg" alt="desk hp" />
                        </td>
                        <td class="unitPrice">
                            <span class="unitPriceDiv">U$ 199.00</span>
                        </td>
                        <td class="totalPrice">
                            <div id="outTotalPrice3">
                            </div>

                        </td>

                    </tr>

                    <tr>

                        <th class="unitPrice" colspan="4">

                            <span class="calcs">Sub Total:</span>

                        <td colspan="2">
                            <div id="outSubTotal" class="totals">

                            </div>
                        </td>
                    </tr>

                    <tr>

                        <th class="unitPrice" colspan="4">

                            <span class="calcs">Taxes:</span>

                        <td colspan="2">
                            <div id="outTaxes" class="totals">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="unitPrice" colspan="4">

                            <span class="calcs">Shipping:</span>

                        </th>
                        <td colspan="2">
                            <div id="outShipping" class="totals">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="unitPrice" colspan="4">
                            <p id="warn">
                                (Please, click to calculate)
                                <span class="calcs" onclick="allTotalPriceFunc()">All Total Price:</span>
                            </p>

                        </th>
                        <td colspan="2">
                            <div id="outAllTotalPrice" class="totals">

                            </div>
                        </td>

                    </tr>
                </table>
                <h2>Payment Method</h2>

                <p>Please enter the credit card information:</p>

                <div class="paymentMethod">
                    <select name="paymentMethod">
                        <option>VISA</option>
                        <option>MASTER CARD</option>
                        <option>AMEX</option>
                        <option>DINERS</option>
                    </select>
                </div>

                <div class="creditCardInfo">
                    <input name="ccNumber" onInput="validationCreditCard(this.value, 'cc1');" size="19" placeholder="Credit Card Number Here" />
                    <span class="cc1" style='color:red'>Invalid Credit Card Number</span>
                </div>

                <div class="creditCardCode">
                    <input name="ccCode" onInput="validationNumber(this.value, 'num1');" size="4" maxlength="4" placeholder="Code" />
                    <span class="num1" style='color:red'>Invalid Code Number</span>

                </div>
                <div class="creditCardDate">
                    <input name="expirationDate" onInput="validationDate(this.value, 'date1');" size="19" maxlength="5" placeholder="Expiration Date - Ex. 01/17" />
                    <span class="date1" style='color:red'>Invalid Date Expiration</span>
                </div>
                <h2>Finish the Shop</h2>
                <div class="buttons">
                    
                    <input type="reset" class="button" value="Reset Shop"/>
                    <input type="submit" class="button" value="Submit Shop" />
                </div>
                
            </div>
        </div>

        
    </form>
</body>
</html>