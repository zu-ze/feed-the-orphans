import React from "react";
import { Text, View, TouchableOpacity} from "react-native";
import { Snackbar } from "react-native-paper";
import Ionicons from 'react-native-vector-icons/Ionicons';
import {styles} from '../core/Theme'
import Background from "../components/Background";
import {useSelector, useDispatch} from 'react-redux'
import { logout, unsetUser } from "../actions";


export const UserHomeScreen = ({navigation, route }) => {
    const isLoggedIn = useSelector( state => state.isLogged)
    const [message, setMessage] = React.useState("");
    const [visible, setVisible] = React.useState(false);
    const onToggleSnackBar = () => setVisible(!visible);
    const onDismissSnackBar = () => setVisible(false);
    const dispatch = useDispatch();

    React.useEffect(() => {
        if (route.params?.status) {
            console.log(route.params)
            // if (message === false){
                setMessage(route.params.message)
                setVisible(true)
            // }
        }
    })

    const _onLogout = () => {
        dispatch(logout());
        dispatch(unsetUser());
    }

    return (
        <Background>
        {isLoggedIn ?
            <View style={[styles.container, { flexDirection: "row", width: '80%' }]}>
                <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onPress={() => navigation.navigate('UserProfile')}
                >
                    <View>
                        <Ionicons name="person" color="white" size={50} />
                        <Text style={styles.text}>Profile</Text>
                    </View>
                </TouchableOpacity>
                <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onPress={() => _onLogout() }
                >
                    <View>
                        <Ionicons name="log-out" color="white" size={50} />
                        <Text style={styles.text}>Logout</Text>
                    </View>
                </TouchableOpacity>
            </View>
        : 
            <View style={[styles.container, { flexDirection: "row", width: '80%' }]} >
                <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onPress={() => navigation.navigate('Register')}
                >
                    <View>
                        <Ionicons name="person-add" color="white" size={50} />
                        <Text style={styles.text}>Register</Text>
                    </View>
                </TouchableOpacity>
                <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onPress={() => navigation.navigate("Login")}
                >
                    <View>
                        <Ionicons name="log-in" color="white" size={50} />
                        <Text style={styles.text}>Login</Text>
                    </View>
                </TouchableOpacity>
            </View>
        }
        <Snackbar
                visible={visible}
                onDismiss={onDismissSnackBar}
                style={{
                    backgroundColor: "#4b88a2"
                }}
            >
                {message}
        </Snackbar>
    </Background>
    )
}
