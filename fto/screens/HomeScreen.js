import React, { useState } from "react";
import { Text, View, TouchableOpacity} from "react-native";
import Ionicons from 'react-native-vector-icons/Ionicons';
import { v4 } from "uuid";
import { Snackbar } from "react-native-paper";
import Background from "../components/Background";
import {styles} from '../core/Theme'

export const HomeScreen = ({navigation, route}) => {
    const [visible, setVisible] = React.useState(false);
    const onToggleSnackBar = () => setVisible(!visible);
    const onDismissSnackBar = () => setVisible(false);

    const [message, setMessage] = React.useState(false);

    React.useEffect( () => {
        if(route.params?.message) {
            if (message === false) {
                setMessage(route.params.message);
                setVisible(true);
            }
        }
    })

    // console.log(v4())
    return (
        <Background>
        <View
            style={[styles.container, {flexDirection: "row"}]}
        >
            <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onPress={() => navigation.navigate('MyArea')}>
                <View >
                    <Ionicons name="map" color="white" size={50} />
                    {/* <FontAwesome size={50} icon={BrandIcons.facebook} /> */}
                    <Text style={styles.text}>My Area</Text>
                </View>
            </TouchableOpacity>
            <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                onPress={() => navigation.navigate("Events")}
            >
                <View>
                    <Ionicons name="person" color="white" size={50} />
                    <Text style={styles.text}>Events</Text>
                </View>                
            </TouchableOpacity>
            <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                onPress={() => navigation.navigate("Find")}
            >
                <View>
                    <Ionicons name="search" color="white" size={50} />
                    <Text style={styles.text}>Find</Text>
                </View>
            </TouchableOpacity>
            <TouchableOpacity  style={[ styles.box, {backgroundColor: "#4b88a2" }]}
                onPress={() => navigation.navigate("Donate")}
            >
                <View>
                    <Ionicons name="wallet" color="white" size={50} />
                    <Text style={styles.text}>Donate</Text>
                </View>
            </TouchableOpacity>
        </View>
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
