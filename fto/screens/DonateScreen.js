import React, { useState } from "react";
import { View, Button} from "react-native";
import TextInput from '../components/TextInput';
import Background from '../components/Background'
import DropDown from "react-native-paper-dropdown";
import {styles} from '../core/Theme'
import { nameValidator, airtelTransValidator, mpambaTransValidator, post, amountValidator } from "../core/Utils";
import { useSelector } from 'react-redux'


export const DonateScreen = ({navigation, route}) => {
    const [donationType, setDonationType] = useState({ value: '', error: '' });
    const donationTypeList = [
        {
            label: "Airtel Money",
            value: "airtel money"
        },
        {
            label: "Mpamba",
            value: "mpamba"
        }
    ];
    const [transationId, setTransationId] = useState({ value: '', error: '' });
    const [phone, setPhone] = useState({ value: '', error: '' });
    const [contactList, setContactList] = useState([]);
    const [orphanageName, setOrphanageName] = useState({ value: '', error: '' });
    const [showDropDown, setShowDropDown] = useState(false);
    const [showDropDown2, setShowDropDown2] = useState(false);
    const [hasContacts, setHasContacts] = useState(false);
    const [amount, setAmount] = useState({value: '', error: ''});
    const [isLoggedIn, setIsLoggedIn] = useState(useSelector( state => state.isLogged))
    const user = useSelector( state => state.user );

    const _onDonate = async () => {
        const donationTypeError = nameValidator(donationType.value);
        let transationIdError = false;
        if (donationType.value === 'airtel money') 
            transationIdError = airtelTransValidator(transationId.value);
        else
            transationIdError = mpambaTransValidator(transationId.value);
        
        const phoneError = nameValidator(phone.value);
        const orphanageNameError = nameValidator(orphanageName.value);
        const amountError =amountValidator(amount.value);

        if ( donationTypeError || transationIdError || 
                phoneError || orphanageNameError || amountError ) {
            setDonationType({...donationType, error: donationTypeError});
            setTransationId({...transationId, error: transationIdError});
            setPhone({...phone, error: phoneError});
            setOrphanageName({...orphanageName, error: orphanageNameError});
            setAmount({...amount, error: amountError});
            return;            
        }

        const json = await post(
            'http://localhost/fto_api/orphanage/read_where.php',
            {
                name: orphanageName.value 
            }
        );

        if( json.status === true ) {

            const result = await post(
                'http://localhost/fto_api/donation/send.php',
                {
                    transId: transationId.value,
                    userId: isLoggedIn? user.id : "1",
                    transType: donationType.value,
                    orphanageId: json.record.id,
                    amount: amount.value
                }
            );

            if (result.status === true ) {
                navigation.navigate('Home', {
                    message: "Donation sent."
                });
            } else {
                console.log("Donation not received...");
                navigation.navigate('Home', {
                    message: "Donation not received."
                });
            }
        } else {
            navigation.navigate('Home', {
                message: "Orphanage Does not exist."
            });        
            console.log("Orphanage Does not exist...");
        }
    }

    React.useEffect(() => {
        if (route.params?.contacts) {
            if(!hasContacts) {
                for (const key in route.params.contacts) {
                    setContactList(prevItems => {
                        return [{
                                label: route.params.contacts[key].number, 
                                value: route.params.contacts[key].number
                            }, ...prevItems
                        ]
                    });  
                }
                setOrphanageName({ value: route.params.orphanageName, error: ''});
            }
            setHasContacts(true);
        }
    });

    return (
        <Background>
        <View style={[styles.container, {flexDirection: "column" }]} >
            <View>
                <DropDown
                    label={"Transaction Type"}
                    mode={"outlined"}
                    visible={showDropDown2}
                    showDropDown={() => setShowDropDown2(true)}
                    onDismiss={() => setShowDropDown2(false)}
                    value={donationType.value}
                    setValue={text => setDonationType({ value: text, error: ''})}
                    list={donationTypeList}
                />
                <TextInput
                    label="TransationId"
                    returnKeyType="next"
                    value={transationId.value}
                    onChangeText={ text => setTransationId({ value: text, error: ''})}
                    error={!!transationId.error}
                    errorText={transationId.error}
                />
                {hasContacts?                     
                    <DropDown
                    label={"Phone"}
                    mode={"outlined"}
                    visible={showDropDown}
                    showDropDown={() => setShowDropDown(true)}
                    onDismiss={() => setShowDropDown(false)}
                    value={phone.value}
                    setValue={text => setPhone({ value: text, error: ''})}
                    list={contactList}
                    />
                :
                    <TextInput
                        label="Phone"
                        returnKeyType="next"
                        value={phone.value}
                        onChangeText={ text => setPhone({ value: text, error: ''})}
                        error={!!phone.error}
                        errorText={phone.error}
                    />
                }
                <TextInput
                    label="Orphanage Name"
                    returnKeyType="next"
                    value={orphanageName.value}
                    onChangeText={ text => setOrphanageName({ value: text, error: ''})}
                    error={!!orphanageName.error}
                    errorText={orphanageName.error}
                />
                <TextInput
                    label="Amount"
                    returnKeyType="done"
                    value={amount.value}
                    onChangeText={ text => setAmount({ value: text, error: ''})}
                    error={!!amount.error}
                    errorText={amount.error}
                />
                <View style={{paddingTop: 5}} >
                    <Button
                        title="Done"
                        onPress={ () => {
                            _onDonate();
                        }}
                    />
                </View>
            </View>     
        </View>
        </Background>
    )
} 
