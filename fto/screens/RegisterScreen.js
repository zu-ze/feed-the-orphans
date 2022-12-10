import React, { useState } from "react";
import { View, Button, ScrollView } from "react-native";
import { ActivityIndicator } from "react-native-paper";
import Ionicons from 'react-native-vector-icons/Ionicons';
import Background from "../components/Background";
import {styles} from '../core/Theme';
import { nameValidator, post, emailValidator, passwordValidator } from "../core/Utils";
import TextInput from "../components/TextInput";

export const RegisterScreen = ({navigation})  => {
    const [role, setRole] = React.useState("donor");
    const [status, setStatus] = React.useState("active");
    const [userName, setUserName] = React.useState({ value: '', error: '' });
    const [email, setEmail] = React.useState({ value: '', error: '' });
    const [phone, setPhone] = React.useState({ value: '', error: '' });
    const [password, setPassword] = React.useState({ value: '', error: '' });
    // const [response, setResponse] = React.useState();

    const [isLoading, setLoading] = React.useState(false)

    const _onRegister = async () => {
        const userNameError = nameValidator(userName.value);
        const emailError = emailValidator(email.value);
        const phoneError = nameValidator(phone.value);
        const passwordError = passwordValidator(password.value);

        if ( userNameError || emailError || phoneError || passwordError) {
            setUserName({...userName, error: userNameError})
            setEmail({...email, error: emailError})
            setPhone({...phone, error: phoneError})
            setPassword({...password, error: passwordError})
            return;
        }

        const json = await post(
            'http://localhost/fto_api/user/register.php',
            {
                role: role,
                status: status,
                userName: userName.value,
                email: email.value,
                phone: phone.value,
                password: password.value,
            },
        );

        if(json.status === true){
            navigation.navigate('Users', {
                response: json
            })
            return;
        }
        else {
            setLoading(false);
            return;
        }
    }

    return (
        <Background>
        <View style={[styles.container, {}]}>

            {isLoading ? <ActivityIndicator color="#4b88a2" size="large" /> : 
            <View>
                <ScrollView style={{ flex: 1}} >
                <TextInput
                    label="username"
                    returnKeyType="next"
                    onChangeText={ text => setUserName({ value: text, error: ''}) }
                    value={userName.value}
                    error={!!userName.error}
                    errorText={userName.error}
                />
                <TextInput
                    label="email"
                    returnKeyType="next"
                    textContentType="emailAddress"
                    onChangeText={ text => setEmail({ value: text, error: ''})}
                    value={email.value}
                    error={!!email.error}
                    errorText={email.error}
                />
                <TextInput
                    label="phone"
                    returnKeyType="next"
                    onChangeText={ text => setPhone({ value: text, error: ''})}
                    value={phone.value}
                    error={!!phone.error}
                    errorText={phone.error}
                />
                <TextInput
                    label="password"
                    returnKeyType="done"
                    textContentType="password"
                    onChangeText={ text => setPassword({ value: text, error: ''})}
                    value={password.value}
                    error={!!password.error}
                    errorText={password.error}
                    secureTextEntry
                />
                <View style={{paddingTop: 5}} >
                    <Button
                        title="Done"
                        onPress={ () => {
                            setLoading(true)
                            _onRegister()
                            setLoading(false)
                        }}
                    />
                </View>
                </ScrollView>
            </View>     
            }
    </View>
    </Background>
    )
}
