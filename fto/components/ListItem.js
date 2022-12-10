import React from 'react';
import {View, Text, StyleSheet, TouchableOpacity} from 'react-native';
// import Icon from 'react-native-vector-icons/dist/FontAwesome'

const ListItem = ({item, show}) => {

  return (
    <TouchableOpacity style={styles.ListItem} onPress={() => show(item.name)}>
        <View style={styles.ListItemView}>
            <Text style={styles.ListItemViewText}>{item.name}</Text>
            <Text style={[styles.ListItemViewText, {fontSize: 16}]}>{item.district}</Text>
        </View>
    </TouchableOpacity>
  );
}

const styles = StyleSheet.create({
    ListItem: {
        padding: 15,
        backgroundColor: "#4b88a288",
        borderBottomWidth: 1,
        borderBottomColor: "#eee",
        height: 50,
        width: '100%',
        // margin: 2.5,
    },
    ListItemView: {
        flexDirection: "row",
        justifyContent: "space-between",
        alignItems: "center",
        alignContent:"center",
        fontColor: 'white'
    },
    ListItemViewText: {
        fontSize: 18
    }
});

export default ListItem;