import React, { useState } from "react";
import { View, Button} from "react-native";
import { ActivityIndicator} from "react-native-paper";
import TextInput from "../components/TextInput";
import Background from '../components/Background';
import Pop from "../components/Pop"
import {styles} from '../core/Theme'
import { nameValidator, passwordValidator, post } from "../core/Utils";
import {useDispatch} from 'react-redux'
import { login, setUser } from "../actions";

export const LoginScreen = ({navigation}) => {
    const [email, setEmail] = React.useState({ value: '', error: '' });
    const [password, setPassword] = React.useState({ value: '', error: '' });
    const [isLoading, setLoading] = React.useState(false)
    // const [response, setResponse] = React.useState();
    const dispatch = useDispatch();

    const _onLogin = async () => {
        const emailError = nameValidator(email.value);
        const passwordError = passwordValidator(password.value);

        if ( emailError || passwordError ) {
            setEmail({...email, error: emailError });
            setPassword({...password, error: passwordError });
            return;
        }

        const json = await post(
            'http://localhost/fto_api/user/login.php',
            {
                email: email.value,
                password: password.value,
            }
            );

        console.log(json);

        if(json.status === true){
            // setResponse(json)
            dispatch(setUser(json.user));
            dispatch(login());
            navigation.navigate('Users', {
                response: json
            })
            return;
        }
        else {
            return;
        }
    }

    return (
        <Background>
        <View style={[styles.container]} >
            {isLoading? <ActivityIndicator color="#4b88a2" size="large" /> :
                <View>
                    <View>
                        <TextInput
                            label="email"
                            returnKeyType="next"
                            textContentType="emailAddress"
                            value={email.value}
                            onChangeText={ text => setEmail({ value: text, error: '' }) }
                            error={!!email.error}
                            errorText={email.error}
                            keyboardType="email-address"
                        />
                    </View>
                    <View>
                        <TextInput
                            label="password"
                            returnKeyType="done"
                            textContentType="password"
                            onChangeText={ text => setPassword({ value: text, error: ''}) }
                            value={password.value}
                            error={!!password.error}
                            errorText={password.error}
                            secureTextEntry
                        />
                    </View>
                    <View style={{paddingTop: 5}} >
                        <Button
                            title="Done"
                            style={styles.button}
                            onPress={ () => {
                                setLoading(true)
                                _onLogin()
                                setLoading(false)
                            }}
                        />
                    </View>
                    <Pop show={false} />
                </View>
            }
        </View>
        </Background>
    )
}
